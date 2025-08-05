<?php

namespace App\View\Components\Dashboard;

use App\Models\Company;
use Illuminate\View\Component;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TotalInnovatorByOrganizationCharts extends Component
{
    public $organizationUnit;
    public $chartData;
    public $company_name;
    public $year;

    /**
     * Create a new component instance.
     *
     * @param string|null $organizationUnit
     * @param int $companyId
     */
    public function __construct($organizationUnit = null, $companyId, $year)
    {
        // Tetapkan nilai default jika $organizationUnit null
        $this->organizationUnit = $organizationUnit ?? 'directorate_name';
        $this->year = $year;

        // Validasi apakah organizationUnit adalah kolom yang valid
        $validOrganizationUnits = [
            'directorate_name',
            'group_function_name',
            'department_name',
            'unit_name',
            'section_name',
            'sub_section_of',
        ];

        if (!in_array($this->organizationUnit, $validOrganizationUnits)) {
            throw new \InvalidArgumentException("Invalid organization unit: {$this->organizationUnit}");
        }

        $company = Company::findOrFail($companyId);
        $companyCode = $company->company_code;
        $this->company_name = $company->company_name;

        if (in_array($companyCode, [2000, 7000])) {
            $filteredCompany = [2000, 7000];
        } else {
            $filteredCompany = [$companyCode];
        }
        
        // Ambil data total inovator
        $pvtQuery = DB::table('teams')
            ->select(
                DB::raw("COALESCE(NULLIF(users.{$this->organizationUnit}, ''), 'Lainnya') as organization_unit"),
                DB::raw('EXTRACT(YEAR FROM events.year) as year'),
                DB::raw('COUNT(DISTINCT CONCAT(pvt_members.employee_id, teams.id)) as total_innovators')
            )
            ->join('pvt_members', 'teams.id', '=', 'pvt_members.team_id')
            ->join('users', 'pvt_members.employee_id', '=', 'users.employee_id')
            ->join('papers', function ($join) {
                $join->on('teams.id', '=', 'papers.team_id')
                    ->where('papers.status', 'accepted by innovation admin');
            })
            ->join('pvt_event_teams', 'pvt_event_teams.team_id', '=', 'teams.id')
            ->join('events', 'events.id', '=', 'pvt_event_teams.event_id')
            ->whereIn('teams.company_code', $filteredCompany)
            ->whereYear('events.year', $this->year)
            ->where('pvt_members.status', '!=', 'gm')
            ->groupBy('organization_unit', 'year');
        
        $ph2Query = DB::table('teams')
            ->select(
                DB::raw("'Outsource' as organization_unit"),
                DB::raw('EXTRACT(YEAR FROM events.year) as year'),
                DB::raw('COUNT(DISTINCT CONCAT(ph2_members.name, teams.id)) as total_innovators')
            )
            ->join('ph2_members', 'teams.id', '=', 'ph2_members.team_id')
            ->join('papers', function ($join) {
                $join->on('teams.id', '=', 'papers.team_id')
                    ->where('papers.status', 'accepted by innovation admin');
            })
            ->join('pvt_event_teams', 'pvt_event_teams.team_id', '=', 'teams.id')
            ->join('events', 'events.id', '=', 'pvt_event_teams.event_id')
            ->whereIn('teams.company_code', $filteredCompany)
            ->whereYear('events.year', $this->year)
            ->groupBy('organization_unit', 'year');
        
        $this->chartData = $pvtQuery->unionAll($ph2Query)
            ->get()
            ->groupBy('organization_unit')
            ->sortByDesc(function ($group) {
                // Total semua innovator dari group ini (semua tahun)
                return $group->sum('total_innovators');
            })
            ->map(function ($data) {
                return $data->keyBy('year')->map(fn($item) => (int)$item->total_innovators);
            });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.total-innovator-by-organization-charts', [
            'chartData' => $this->chartData,
            'organizationUnit' => $this->organizationUnit,
            'company_name' => $this->company_name
        ]);
    }
}