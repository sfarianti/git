<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportUserData;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Exception;

class ImportUserDataExcel extends Controller
{
    public function importFromUpload(Request $request)
    {
        $request->validate([
            'formFile' => 'required|file|mimes:xlsx,xls,csv',
        ]);
    
        try {
            $file = $request->file('formFile');
            $import = new ImportUserData();
            Excel::import($import, $file);
    
            return redirect()->back()->with('success', 'Data Pengguna berhasil diimport.');
        } catch (Exception $e) {
            return redirect()->back()->with('success', 'Terjadi Kesalahan: '.$e->getMessage());
        }
    }
}
