<?php

namespace App\Observers;

use App\Models\Paper;
use App\Models\History;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PDFMerger;

class PaperObserver
{
    protected $models = [
        Paper::class,
    ];

    public function updating(Paper $paper)
    {
        $category_name = Team::join('categories', 'categories.id', '=', 'teams.category_id')
            ->join('papers', 'papers.team_id', '=', 'teams.id')
            ->where('papers.id', $paper->id)
            ->pluck('categories.category_name')
            ->toArray()[0];
        if (
            $paper->step_1 != null && $paper->step_2 != null && $paper->step_3 != null &&
            $paper->step_4 != null && $paper->step_5 != null && $paper->step_6 != null &&
            $paper->step_7 != null && ($paper->full_paper != null ? $paper->full_paper[0] == 'w' : true) &&
            (($paper->step_8 == '-' && (strpos($category_name, "GKM") === false)) || ($paper->step_8 != null && (strpos($category_name, "GKM") !== false)))
        ) {
            if ($paper->step_8 == '-' && (strpos($category_name, "GKM") === false))
                $stage = ['step_1', 'step_2', 'step_3', 'step_4', 'step_5', 'step_6', 'step_7'];
            else
                $stage = ['step_1', 'step_2', 'step_3', 'step_4', 'step_5', 'step_6', 'step_7', 'step_8'];

            $item = Paper::where('id', '=', $paper->id)->select($stage)->get()[0];

            $mpdf = new Mpdf();

            $team = Team::findOrFail($paper->team_id);

            $pdfMerger = PDFMerger::init();

            foreach ($item->toArray() as $name_column => $column) {
                if ($column == null) {
                    continue;
                }

                // $pdfMerger->addPDF(Storage::path('public/internal/'.$team->status_lomba.'/'.$team->team_name.'/'.$name_column.'.pdf'), 'all');
                $pdfMerger->addPDF(public_path('storage/internal/' . $team->status_lomba . '/' . $team->team_name . '/' . $name_column . '.pdf'), 'all');



                // $mpdf->AddPage();

                // if($column[0] == 'w'){
                //     $mpdf->WriteHTML(mb_substr($column, 3));
                // }elseif($column[0] == 'f'){
                //     $pageCount = $mpdf->SetSourceFile(Storage::path('public/'.mb_substr($column, 3)));

                //     for ($i = 1; $i <= $pageCount; $i++) {
                //         $templateId = $mpdf->ImportPage($i);
                //         $mpdf->UseTemplate($templateId);
                //     }
                // }
            }

            // $filepath = Storage::path('public/internal/' . $team->status_lomba . '/' . $team->team_name . "/full_paper.pdf");
            $filepath = public_path('storage/internal/' . $team->status_lomba . '/' . $team->team_name . "/full_paper.pdf");
            $pdfMerger->merge();
            $pdfMerger->save($filepath);
            $paper->full_paper = 'w: internal/' . $team->status_lomba . '/' . $team->team_name . "/full_paper.pdf";
        }

        if ((($paper->step_1 != null && $paper->step_2 != null && $paper->step_3 != null &&
            $paper->step_4 != null && $paper->step_5 != null && $paper->step_6 != null &&
            $paper->step_7 != null && $paper->step_8 != null) || $paper->full_paper != null) && $paper->status == "not finish") {
            // dd($paper);
            $paper->status = "upload full paper";
        } elseif (((($paper->step_1 == "" || $paper->step_2 == "" || $paper->step_3 == "" ||
            $paper->step_4 == "" || $paper->step_5 == "" || $paper->step_6 == "" ||
            $paper->step_7 == "" || $paper->step_8 == "") && $paper->full_paper == null)) && $paper->status == "upload full paper") {
            // dd($paper);
            $paper->status = "not finish";
        }
    }
}