<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baram;
use App\Models\Dabrang;
use App\Models\Supplier;
use App\Models\Jebrang;

class BaramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load supplier, dabrang, dan jebrangs
        $baram = Baram::with(['supplier', 'dabrang.jebrang'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('barams.index', compact('baram'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $dabrangs  = Dabrang::with('jebrang')->get();
        $jebrangs  = Jebrang::all(); // ⬅️ tambahan

        return view('barams.create', compact('suppliers', 'dabrangs', 'jebrangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_transaksi'  => 'required|string|max:50',
            'tgl_masuk'     => 'required|date',
            'supplier_id'   => 'required|exists:suppliers,id',
            'dabrang_id'    => 'required|exists:dabrangs,id',
            'jebrang_id'    => 'required|exists:jebrangs,id',
            'jumlah_masuk'  => 'required|integer|min:1',
            'harga_beli'    => 'required|numeric|min:0',
            // 'total_harga'   => 'required|numeric|min:0', // ⬅️ dihapus karena dihitung otomatis
        ]);

        // Hitung total_harga
        $validated['total_harga'] = $validated['jumlah_masuk'] * $validated['harga_beli'];

        Baram::create($validated);

        return redirect()->route('barams')->with('success', 'Transaksi Barang Masuk created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $baram = Baram::with(['supplier', 'dabrang.jebrang'])->findOrFail($id);

        return view('barams.show', compact('baram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $baram     = Baram::with(['supplier', 'dabrang.jebrang'])->findOrFail($id);
        $suppliers = Supplier::all();
        $dabrangs  = Dabrang::with('jebrang')->get();
        $jebrangs  = Jebrang::all();

        return view('barams.edit', compact('baram', 'suppliers', 'dabrangs', 'jebrangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'no_transaksi'  => 'required|string|max:50',
            'tgl_masuk'     => 'required|date',
            'supplier_id'   => 'required|exists:suppliers,id',
            'dabrang_id'    => 'required|exists:dabrangs,id',
            'jebrang_id'    => 'required|exists:jebrangs,id',
            'jumlah_masuk'  => 'required|integer|min:1',
            'harga_beli'    => 'required|numeric|min:0',
            // 'total_harga'   => 'required|numeric|min:0', // ⬅️ dihapus karena dihitung otomatis
        ]);

        $validated['total_harga'] = $validated['jumlah_masuk'] * $validated['harga_beli'];

        $baram = Baram::findOrFail($id);
        $baram->update($validated);

        return redirect()->route('barams')->with('success', 'Transaksi Barang Masuk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $baram = Baram::findOrFail($id);
        $baram->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi Barang Masuk deleted successfully.'
        ]);
    }
}