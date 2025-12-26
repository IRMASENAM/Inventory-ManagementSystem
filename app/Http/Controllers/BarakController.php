<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barak;
use App\Models\Dabrang;
use App\Models\Pod;

class BarakController extends Controller
{
    /**
     * Tampilkan semua data transaksi barang keluar.
     */
    public function index()
    {
        // Ambil semua data transaksi + relasi barang & POD
        $barak = Barak::with(['dabrang', 'pod'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('baraks.index', compact('barak'));
    }

    /**
     * Tampilkan form tambah transaksi baru.
     */
    public function create()
    {
        $dabrangs = Dabrang::all(); // daftar barang
        $pods = Pod::orderBy('tanggal', 'desc')->get(); // daftar POD

        return view('baraks.create', compact('dabrangs', 'pods'));
    }

    /**
     * Simpan transaksi baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_transaksi'   => 'required|string|max:50',
            'tgl_keluar'     => 'required|date',
            'dabrang_id'     => 'required|exists:dabrangs,id',
            'pod_id'         => 'required|exists:pods,id', // relasi ke POD
            'jumlah_keluar'  => 'required|integer|min:1',
        ]);

        Barak::create($validated);

        return redirect()->route('baraks')->with('success', 'Transaksi barang keluar berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail transaksi tertentu.
     */
    public function show(string $id)
    {
        $barak = Barak::with(['dabrang', 'pod'])->findOrFail($id);
        return view('baraks.show', compact('barak'));
    }

    /**
     * Tampilkan form edit transaksi.
     */
    public function edit(string $id)
    {
        $barak = Barak::findOrFail($id);
        $dabrangs = Dabrang::all();
        $pods = Pod::orderBy('tanggal', 'desc')->get();

        return view('baraks.edit', compact('barak', 'dabrangs', 'pods'));
    }

    /**
     * Update transaksi barang keluar.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'no_transaksi'   => 'required|string|max:50',
            'tgl_keluar'     => 'required|date',
            'dabrang_id'     => 'required|exists:dabrangs,id',
            'pod_id'         => 'required|exists:pods,id',
            'jumlah_keluar'  => 'required|integer|min:1',
        ]);

        $barak = Barak::findOrFail($id);
        $barak->update($validated);

        return redirect()->route('baraks')->with('success', 'Transaksi barang keluar berhasil diperbarui.');
    }

    /**
     * Hapus transaksi dari database.
     */
    public function destroy(string $id)
    {
        $barak = Barak::findOrFail($id);
        $barak->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi barang keluar berhasil dihapus.'
        ]);
    }
}
