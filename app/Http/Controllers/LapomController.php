<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapom;
use App\Models\Supplier;
use App\Models\Dabrang;

class LapomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapom = Lapom::with(['supplier', 'barang'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('lapoms.index', compact('lapom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $barangs = Dabrang::all();

        return view('lapoms.create', compact('suppliers', 'barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'barang_id'   => 'required|exists:dabrangs,id',
            'jumlah'      => 'required|integer|min:1',
            'tanggal'     => 'required|date',
        ]);

        Lapom::create($request->all());

        return redirect()->route('lapoms.index')->with('success', 'Laporan Masuk created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lapom = Lapom::with(['supplier', 'barang'])->findOrFail($id);

        return view('lapoms.show', compact('lapom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lapom = Lapom::findOrFail($id);
        $suppliers = Supplier::all();
        $barangs = Dabrang::all();

        return view('lapoms.edit', compact('lapom', 'suppliers', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'barang_id'   => 'required|exists:dabrangs,id',
            'jumlah'      => 'required|integer|min:1',
            'tanggal'     => 'required|date',
        ]);

        $lapom = Lapom::findOrFail($id);
        $lapom->update($request->all());

        return redirect()->route('lapoms.index')->with('success', 'Laporan Masuk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lapom = Lapom::findOrFail($id);
        $lapom->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan Masuk deleted successfully.'
        ]);
    }
};