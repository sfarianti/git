<?php

namespace App\Http\Livewire\Assessment;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CaucusTeamTotal extends Component
{
    public $eventId;

    protected $listeners = ['eventChanged' => 'updateEvent'];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    public function updateEvent($eventId)
    {
        $this->eventId = $eventId;
    }
    
    public function render()
    {
        $employeeId = Auth::user()->employee_id;
        $role = strtolower(Auth::user()->role);
        $isSuperadmin = in_array($role, ['superadmin', 'admin']);
        
        $completeAssessment = DB::table('pvt_assesment_team_judges')
            ->join('judges', 'judges.id', '=', 'pvt_assesment_team_judges.judge_id')
            ->join('pvt_event_teams', 'pvt_event_teams.id', '=', 'pvt_assesment_team_judges.event_team_id')
            ->join('teams', 'teams.id', '=', 'pvt_event_teams.team_id')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('pvt_event_teams.event_id', $this->eventId)
            ->where('pvt_assesment_team_judges.stage', 'caucus')
            ->when(!$isSuperadmin, function ($query) use ($employeeId) {
                $query->where('judges.employee_id', $employeeId);
            })
            ->groupBy(
                'pvt_event_teams.id',
                'teams.team_name',
                'teams.category_id',
                'categories.category_name'
            )
            ->havingRaw('COUNT(*) = SUM(CASE WHEN score != 0 THEN 1 ELSE 0 END)')
            ->select(
                'pvt_event_teams.id as event_team_id',
                'teams.team_name',
                'teams.category_id',
                'categories.category_name'
            )
            ->get();
        $categoriesDataComplete = $completeAssessment->groupBy('category_name');

        $notCompleteAssessment = DB::table('pvt_assesment_team_judges')
            ->join('judges', 'judges.id', '=', 'pvt_assesment_team_judges.judge_id')
            ->join('pvt_event_teams', 'pvt_event_teams.id', '=', 'pvt_assesment_team_judges.event_team_id')
            ->join('teams', 'teams.id', '=', 'pvt_event_teams.team_id')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('pvt_event_teams.event_id', $this->eventId)
            ->where('pvt_assesment_team_judges.stage', 'caucus')
            ->when(!$isSuperadmin, function ($query) use ($employeeId) {
                $query->where('judges.employee_id', $employeeId);
            })
            ->groupBy(
                'pvt_event_teams.id',
                'teams.team_name',
                'teams.category_id',
                'categories.category_name'
            )
            ->havingRaw('COUNT(*) > SUM(CASE WHEN score != 0 THEN 1 ELSE 0 END)')
            ->select(
                'pvt_event_teams.id as event_team_id',
                'teams.team_name',
                'teams.category_id',
                'categories.category_name'
            )
            ->get();
        $categoriesDataNotComplete = $notCompleteAssessment->groupBy('category_name');
        
        return view('livewire.assessment.caucus-team-total', [
            'totalCompleteAssessment' => $completeAssessment->count(),
            'categoriesDataComplete' => $categoriesDataComplete,
            'categoriesDataNotComplete' => $categoriesDataNotComplete,
            'totalNotCompleteAssessment' => $notCompleteAssessment->count(),
            'totalTeams' => $notCompleteAssessment->count() + $completeAssessment->count(),
        ]);
    }
}