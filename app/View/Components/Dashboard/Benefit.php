<?php

namespace App\View\Components\Dashboard;

use App\Models\Event;
use App\Models\Paper;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class Benefit extends Component
{
    public $year;
    public $charts = [
        'labels' => [],
        'data' => [],
        'logos' => []
    ];
    public $isSuperadmin;
    public $userCompanyCode;
    public $availableYears;

    public function __construct($year = null, $isSuperadmin, $userCompanyCode)
    {
        $this->year = $year ?? date('Y');
        $this->isSuperadmin = $isSuperadmin;
        $this->userCompanyCode = $userCompanyCode;
        $yearNow = Carbon::now()->year;
        
        if(in_array($this->userCompanyCode, [2000, 7000])) {
            $filteredCompanyCode = [2000, 7000];
        } else {
            $filteredCompanyCode = [$this->userCompanyCode];
        }

        // Status benefit yang sudah disetujui
        $acceptedStatuses = [
            'accepted by innovation admin',
        ];
        
        $teamsStatusCompe = ['internal', 'group'];

        // Mengambil data total benefit untuk setiap perusahaan berdasarkan status yang sudah disetujui
        $query = Paper::join('teams', 'papers.team_id', '=', 'teams.id')
            ->join('companies', 'teams.company_code', '=', 'companies.company_code')
            ->join('pvt_event_teams', 'teams.id', '=', 'pvt_event_teams.team_id')
            ->join('events', 'pvt_event_teams.event_id', '=', 'events.id')
            ->selectRaw('companies.company_name, companies.company_code, SUM(DISTINCT papers.financial + papers.potential_benefit) as total_benefit, companies.sort_order')
            ->whereIn('papers.status', $acceptedStatuses)
            ->where('events.status', 'finish')
            ->whereIn('teams.status_lomba', $teamsStatusCompe)
            ->groupBy('companies.company_name', 'companies.sort_order', 'companies.company_code')
            ->orderBy('companies.sort_order');

        // Filter data berdasarkan company_code 2000 jika bukan superadmin
        if (!$this->isSuperadmin) {
            $query->whereIn('teams.company_code', $filteredCompanyCode);
        }

        $data = $query->get();

        // Gabungkan data dari company_code 7000 ke dalam company_code 2000
        $company2000Data = $data->where('company_code', '2000')->first();
        $company7000Data = $data->where('company_code', '7000')->first();

        // Jika ada data untuk kedua perusahaan, akumulasi data dari company 7000 ke company 2000
        if ($company2000Data && $company7000Data) {
            $company2000Data->total_benefit += $company7000Data->total_benefit;

            // Hapus data untuk company_code 7000 jika sudah digabung
            $data = $data->reject(function ($item) {
                return $item->company_code === '7000';
            });
        }

        // Menambahkan data yang sudah digabungkan ke dalam charts
        foreach ($data as $row) {
            $company = $row->company_name;

            $sanitizedCompanyName = preg_replace('/[^a-zA-Z0-9_()]+/', '_', strtolower($company));
            $sanitizedCompanyName = preg_replace('/_+/', '_', $sanitizedCompanyName);
            $sanitizedCompanyName = trim($sanitizedCompanyName, '_');

            $logoPath = public_path('assets/logos/' . $sanitizedCompanyName . '.png');
            if (!file_exists($logoPath)) {
                $logoPath = asset('assets/logos/pt_semen_indonesia_tbk.png');
            } else {
                $logoPath = asset('assets/logos/' . $sanitizedCompanyName . '.png');
            }

            $this->charts['labels'][] = $company;
            $this->charts['data'][] = $row->total_benefit;
            $this->charts['logos'][] = $logoPath;
        }

        // Get available years for the dropdown
        $this->availableYears = Event::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    public function render()
    {
        return view('components.dashboard.benefit', [
            'charts' => $this->charts,
            'year' => $this->year,
            'availableYears' => $this->availableYears,
        ]);
    }
}