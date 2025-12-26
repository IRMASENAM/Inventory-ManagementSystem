<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sabrang;


class SabrangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sabrang = Sabrang::orderBy('created_at', 'DESC')->get();
        return view('sabrangs.index', compact('sabrang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sabrangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Sabrang::create($request->all());
        return redirect()->route('sabrangs')->with('success', 'Satuan Barang created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sabrang = Sabrang::findOrFail($id);
        return view('sabrangs.show', compact('sabrang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sabrang = Sabrang::findOrFail($id);
        return view('sabrangs.edit', compact('sabrang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sabrang = Sabrang::findOrFail($id);
        $sabrang->update($request->all());
        return redirect()->route('sabrangs')->with('success', 'Satuan Barang updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sabrang = Sabrang::findOrFail($id);
        $sabrang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Satuan Barang deleted successfully.'
        ]);
    }
}
