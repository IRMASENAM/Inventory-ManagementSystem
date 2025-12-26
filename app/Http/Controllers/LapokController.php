<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapok;

class LapokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapok = Lapok::orderBy('created_at', 'DESC')->get();
        return view('lapoks.index', compact('lapok'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lapoks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Lapok::create($request->all());
        return redirect()->route('lapoks')->with('success', 'Laporan Keluar created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lapok = Lapok::findOrFail($id);
        return view('lapoks.show', compact('lapok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lapok = Lapok::findOrFail($id);
        return view('lapoks.edit', compact('lapok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lapok = Lapok::findOrFail($id);
        $lapok->update($request->all());
        return redirect()->route('lapoks')->with('success', 'Laporan Keluar updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lapok = Lapok::findOrFail($id);
        $lapok->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan Keluar deleted successfully.'
        ]);
    }
}
