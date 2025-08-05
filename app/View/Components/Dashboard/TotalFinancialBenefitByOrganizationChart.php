<?php

namespace App\View\Components\Dashboard;

use App\Models\Company;
use Illuminate\View\Component;
use App\Models\Paper;
use Illuminate\Support\Facades\DB;

class TotalFinancialBenefitByOrganizationChart extends Component
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

        // Ambil data total financial benefit
        $this->chartData = Paper::select(
            DB::raw("COALESCE(users.{$this->organizationUnit}, 'Lainnya') as organization_unit"),
            'events.year as year',
            DB::raw('SUM(papers.financial) as total_financial')
        )
            ->join('teams', 'papers.team_id', '=', 'teams.id')
            ->join('pvt_members', function ($join) {
                $join->on('teams.id', '=', 'pvt_members.team_id')
                    ->where('pvt_members.status', 'leader'); // Hanya ambil leader
            })
            ->join('users', 'pvt_members.employee_id', '=', 'users.employee_id')
            ->join('pvt_event_teams', 'pvt_event_teams.team_id', '=', 'teams.id')
            ->join('events', 'events.id', '=', 'pvt_event_teams.event_id')
            ->where('teams.company_code', $companyCode)
            ->where('papers.status', 'accepted by innovation admin')
            ->whereYear('events.year', $this->year)
            ->groupBy(DB::raw("COALESCE(users.{$this->organizationUnit}, 'Lainnya')"), 'events.year')
            ->orderBy('total_financial', 'DESC')
            ->get()
            ->groupBy('organization_unit')
            ->map(function ($data) {
                return $data->keyBy('year')->map(fn($item) => $item->total_financial);
            });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.total-financial-benefit-by-organization-chart', [
            'chartData' => $this->chartData,
            'organizationUnit' => $this->organizationUnit,
            'company_name' => $this->company_name,
        ]);
    }
}