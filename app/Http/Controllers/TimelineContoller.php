<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineContoller extends Controller
{
     // Menampilkan semua timeline
     public function index()
     {
         $timeline = Timeline::all();
         return view('admin.timeline.timeline', compact('timeline'));
     }

     // Menampilkan halaman form untuk membuat kegiatan baru

     // Menyimpan kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        Timeline::create($request->all());
        return redirect()->route('timeline.index')
                         ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function destroy(Timeline $timeline)
    {
        $timeline->delete();
        return redirect()->route('timeline.index')
                         ->with('success', 'Kegiatan berhasil dihapus.');
    }

}
