<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jebrang;

class JebrangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jebrang = Jebrang::orderBy('created_at', 'DESC')->get();
        return view('jebrangs.index', compact('jebrang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jebrangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Jebrang::create($request->all());
        return redirect()->route('jebrangs')->with('Success', 'Jenis Barang Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jebrang = Jebrang::findOrFail($id);
        return view('jebrangs.show', compact('jebrang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jebrang = Jebrang::findOrFail($id);
        return view('jebrangs.edit', compact('jebrang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jebrang = Jebrang::findOrFail($id);
        $jebrang->update($request->all());
        return redirect()->route('jebrangs')->with('Success', 'Jenis Barang Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jebrang = Jebrang::findOrFail($id);
        $jebrang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jenis Barang Deleted Successfully.'
        ]);
    }
}