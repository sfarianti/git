<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showDashboard(Request $request)
    {
        // Menghitung jumlah tim berdasarkan kategori utama
        $breakthroughInnovation = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_parent', 'BREAKTHROUGH INNOVATION')
            ->count();

        $incrementalInnovation = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_parent', 'INCREMENTAL INNOVATION')
            ->count();

        $ideaBox = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_parent', 'IDEA BOX')
            ->count();

        // Menghitung jumlah tim berdasarkan kategori detail dalam "Breakthrough Innovation"
        $detailBreakthroughInnovationPBB = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'PRODUK DAN BAHAN BAKU')
            ->count();

        $detailBreakthroughInnovationTPP = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'TEKHNOLOGY & PROSES PRODUKSI')
            ->count();

        $detailBreakthroughInnovationManagement = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'MANAGEMENT')
            ->count();

        // Menghitung jumlah tim berdasarkan kategori detail dalam "Incremental Innovation"
        $detailIncrementalInnovationGKMPlant = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'GKM PLANT')
            ->count();

        $detailIncrementalInnovationGKMOffice = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'GKM OFFICE')
            ->count();

        $detailIncrementalInnovationPKMPlant = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'PKM PLANT')
            ->count();

        $detailIncrementalInnovationPKMOffice = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'PKM OFFICE')
            ->count();

        $detailIncrementalInnovationSSPlant = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'SS PLANT')
            ->count();

        $detailIncrementalInnovationSSOffice = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'SS OFFICE')
            ->count();

        // Menghitung jumlah tim berdasarkan kategori detail dalam "Idea Box"
        $detailIdeaBoxIdea = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id')
            ->where('categories.category_name', 'IDEA')
            ->count();

        // $semenCountTeam = Team::join('categories', 'categories.id', '=', 'teams.category_id')
        //         ->selectRaw('category_name as cat_name, Count(*) as count')
        //         ->groupBy('cat_name')
        //         ->orderBy('cat_name')
        //         ->get();



        // $labels = [];
        // $datas = [];

        // $colors = ['#36A2EB', '#FF6384', '#4BC0C0', '#FF9F40', '#9966FF', '#FFCD56', '#C9CBCF', '#E0AED0', '#FFC004', 'FF9800'];

        // $realisasiCountTeam = Team::join('companies', 'teams.company_code', '=', 'companies.company_code')
        //         ->selectRaw('company_name as co_name, Count(*) as count')
        //         ->groupBy('co_name')
        //         ->orderBy('co_name')
        //         ->get();
        // $labelReals = [];
        // $dataReals = [];

        // foreach ($semenCountTeam as $data) {
        //     array_push($labels, $data->cat_name);
        //     array_push($datas, $data->count);
        // }
        // $datasetSemens = [
        //     [
        //         'label' => 'Team',
        //         'data' => $datas,
        //         'backgroundColor' => $colors
        //     ]
        // ];
        // foreach ($realisasiCountTeam as $datareal) {
        //     array_push($labels, $datareal->co_name);
        //     array_push($datas, $datareal->count);
        // }
        // $datasetReals = [
        //     [
        //         'label' => 'Realisasi Team',
        //         'data' => $datas,
        //         'backgroundColor' => $colors
        //     ]
        // ];
        return view('auth.user.home', compact('breakthroughInnovation', 'incrementalInnovation', 'ideaBox', 'detailBreakthroughInnovationPBB', 'detailBreakthroughInnovationTPP', 'detailBreakthroughInnovationManagement', 'detailIncrementalInnovationGKMPlant', 'detailIncrementalInnovationGKMOffice', 'detailIncrementalInnovationPKMPlant', 'detailIncrementalInnovationPKMOffice', 'detailIncrementalInnovationSSPlant', 'detailIncrementalInnovationSSOffice', 'detailIdeaBoxIdea'));
    }
}
