<?php

namespace App\Http\Controllers;

use App\Models\Flyer;
use Illuminate\Http\Request;

class FlyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flyer = Flyer::all();
        return view('admin.flyer.flyer_index', [
            'flyer' => $flyer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'flyer_path' => 'required|image|file'
        ]);

        $validated_data['flyer_path'] = $request->file('flyer_path')->store('flyer');

        Flyer::create($validated_data);

        return redirect()->route('flyer.index')->with('success', 'Berhasil menambah flyer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flyer  $flyer
     * @return \Illuminate\Http\Response
     */
    public function show(Flyer $flyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flyer  $flyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Flyer $flyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flyer  $flyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flyer $flyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flyer  $flyer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flyer = Flyer::findOrFail($id);

        $flyer->delete();

        return redirect()->route('flyer.index')->with('success', 'Berhasil menghapus flyer');
    }
}
