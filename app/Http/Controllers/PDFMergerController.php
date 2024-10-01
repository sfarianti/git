<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class PDFMergerController extends Controller
{
    public function merge(Request $request)
    {
        $files = $request->file('files');
        // $localFilePath = Storage::disk('public')->url('assets/file.txt');
        $localFilePath = Storage::disk('public')->path('assets/file1.pdf');
        $localFilePath2 = Storage::disk('public')->path('fileku/file2.pdf');

        // Check if the local file exists
        if (!file_exists($localFilePath)) {
            return response()->json(['error' => 'Local file not found.'], 404);
        }

        if ($request->hasFile('files')) {
            $pdf = PDFMerger::init();
            // $pdf->addPDF($localFilePath, 'all');
            // foreach ($files as $file) {
            //     $pdf->addPDF($file->getRealPath(), 'all');
            // }
            $pdf->addPDF($localFilePath2, 'all');
            $pdf->addPDF($localFilePath, 'all');
            $pdf->merge();
            $filename = time() . '.pdf';
            Storage::disk('public')->put($filename, $pdf->output());

            return response()->download(storage_path('app/public/' . $filename));
        }

        return response()->json(['error' => 'No files were provided.'], 400);
    }
}
