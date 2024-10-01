<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Paper;
use Carbon\Carbon;

class ChartDashboardController extends Controller
{
    public function semenTeamChart(){
        $datasets = Team::join('categories', 'categories.id', '=', 'teams.category_id')
            ->join('companies', 'companies.company_code', '=', 'teams.company_code')
            ->selectRaw('categories.category_name as cat_name, Count(*) as count')
            ->where('companies.group', 'Semen')
            ->whereYear('teams.created_at', '>=', Carbon::now()->subYears(4)->year)
            ->groupBy('cat_name')
            ->orderBy('cat_name')
            ->get();
        return response()->json($datasets);
    }

    public function NonSemenTeamChart(){
        $datasets = Team::join('categories', 'categories.id', '=', 'teams.category_id')
            ->join('companies', 'companies.company_code', '=', 'teams.company_code')
            ->selectRaw('categories.category_name as cat_name, Count(*) as count')
            ->where('companies.group', 'Non Semen')
            ->whereYear('teams.created_at', '>=', Carbon::now()->subYears(4)->year)
            ->groupBy('cat_name')
            ->orderBy('cat_name')
            ->get();
        return response()->json($datasets);
    }

    public function realisasiTeamChart(){
        $datasets = Team::join('companies', 'teams.company_code', '=', 'companies.company_code')
            ->selectRaw('companies.company_name, EXTRACT(YEAR FROM teams.created_at) as year, COUNT(teams.id) as count')
            ->whereYear('teams.created_at', '>=', Carbon::now()->subYears(4)->year)
            ->groupBy('companies.company_name', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('companies.company_name')
            ->get();
        return response()->json($datasets);
    }

    public function realisasiKaryawanChart(){
        $datasets = Team::join('pvt_members', 'teams.id', '=', 'pvt_members.team_id')
            ->join('companies', 'teams.company_code', '=', 'companies.company_code')
            ->selectRaw('companies.company_name as company_name, COUNT(DISTINCT pvt_members.id) as employee_count')
            ->whereYear('teams.created_at', '>=', Carbon::now()->subYears(4)->year)
            ->groupBy('company_name')
            ->orderBy('company_name')
            ->get();

        return response()->json($datasets);
    }

    public function benefitTeamChart() {
        $datasets = Team::join('papers', 'teams.id', '=', 'papers.team_id')
            ->join('companies', 'companies.company_code', '=', 'teams.company_code')
            ->selectRaw('companies.company_name as co_name, SUM(papers.financial) as total')
            ->whereYear('teams.created_at', '>=', Carbon::now()->subYears(4)->year)
            ->groupBy('co_name')
            ->orderBy('co_name')
            ->get();

        return response()->json($datasets);
    }
}








// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Team;
// use App\Models\Paper;
// class ChartDashboardController extends Controller
// {
//     // public function getDataChart(){
//     //     $data=DB::table('teams')
//     //     ->
//     // }
//     public function semenTeamChart(){
//         $datasets = Team::join('categories', 'categories.id', '=', 'teams.category_id')
//             ->join('companies', 'companies.company_code', '=', 'teams.company_code')
//             ->selectRaw('categories.category_name as cat_name, Count(*) as count')
//             ->where('companies.group', 'Semen')
//             ->groupBy('cat_name')
//             ->orderBy('cat_name')
//             ->get();
//         return response()->json($datasets);
//     }

//     public function NonSemenTeamChart(){
//         $datasets = Team::join('categories', 'categories.id', '=', 'teams.category_id')
//             ->join('companies', 'companies.company_code', '=', 'teams.company_code')
//             ->selectRaw('categories.category_name as cat_name, Count(*) as count')
//             ->where('companies.group', 'Non Semen')
//             ->groupBy('cat_name')
//             ->orderBy('cat_name')
//             ->get();
//         return response()->json($datasets);
//     }

//     public function realisasiTeamChart(){
//         $datasets = Team::join('companies', 'teams.company_code', '=', 'companies.company_code')
//             ->selectRaw('companies.company_name, EXTRACT(YEAR FROM teams.created_at) as year, COUNT(teams.id) as count')
//             ->groupBy('companies.company_name', 'year')
//             ->orderBy('year', 'asc')  // Ubah ke 'desc' jika ingin descending
//             ->orderBy('companies.company_name')
//             ->get();
//         return response()->json($datasets);
//     }

//     public function realisasiKaryawanChart(){
//        $datasets = Team::join('pvt_members', 'teams.id', '=', 'pvt_members.team_id')
//             ->join('companies', 'teams.company_code', '=', 'companies.company_code')
//             ->selectRaw('companies.company_name as company_name, COUNT(DISTINCT pvt_members.id) as employee_count')
//             ->groupBy('company_name')
//             ->orderBy('company_name')
//             ->get();

//         return response()->json($datasets);

//     }
//     public function benefitTeamChart() {
//         $datasets = Team::join('papers', 'teams.id', '=', 'papers.team_id')
//             ->join('companies', 'companies.company_code', '=', 'teams.company_code')
//             ->selectRaw('companies.company_name as co_name, SUM(papers.financial) as total')
//             ->groupBy('co_name')
//             ->orderBy('co_name')
//             ->get();

//         return response()->json($datasets);
//     }

// }
