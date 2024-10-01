<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function table(){
    //     return view('auth.user.home', compact('data'));
    // }

    public function showDashboard(Request $request)
    {
        $breakthroughInnovation = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_parent') // Use 'categories' here, not 'category'
            ->where('categories.category_parent', '=', 'BREAKTHROUGH INNOVATION')
            ->count();
        $incrementalInnovation = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_parent') // Use 'categories' here, not 'category'
            ->where('categories.category_parent', '=', 'INCREMENTAL INNOVATION')
            ->count();
        $ideaBox = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_parent') // Use 'categories' here, not 'category'
            ->where('categories.category_parent', '=', 'IDEA BOX')
            ->count();

        $detailBreakthroughInnovationPBB = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'PRODUK DAN BAHAN BAKU')
            ->count();
        $detailBreakthroughInnovationTPP = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'TEKHNOLOGY & PROSES PRODUKSI')
            ->count();
        $detailBreakthroughInnovationManagement = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'MANAGEMENT')
            ->count();


        $detailIncrementalInnovationGKMPlant = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'GKM PLANT')
            ->count();
        $detailIncrementalInnovationGKMOffice = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'GKM OFFICE')
            ->count();
        $detailIncrementalInnovationPKMPlant = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'PKM PLANT')
            ->count();
        $detailIncrementalInnovationPKMOffice = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'PKM OFFICE')
            ->count();

        $detailIncrementalInnovationSSPlant = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'SS PLANT')
            ->count();
        $detailIncrementalInnovationSSOffice = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'SS OFFICE')
            ->count();

        $detailIdeaBoxIdea = DB::table('teams')
            ->join('categories', 'categories.id', '=', 'teams.category_id') // Use 'categories' here, not 'category'
            ->select('categories.category_name') // Use 'categories' here, not 'category'
            ->where('categories.category_name', '=', 'IDEA')
            ->count();


        return view('auth.user.home', compact('breakthroughInnovation', 'incrementalInnovation', 'ideaBox', 'detailBreakthroughInnovationPBB', 'detailBreakthroughInnovationTPP', 'detailBreakthroughInnovationManagement', 'detailIncrementalInnovationGKMPlant', 'detailIncrementalInnovationGKMOffice', 'detailIncrementalInnovationPKMPlant', 'detailIncrementalInnovationPKMOffice', 'detailIncrementalInnovationSSPlant', 'detailIncrementalInnovationSSOffice', 'detailIdeaBoxIdea'));
    }
}
