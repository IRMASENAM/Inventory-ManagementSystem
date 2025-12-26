<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dabrang;
use App\Models\Jebrang;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;

class DabrangController extends Controller
{
    /**
     * Tampilkan daftar barang dengan QR Code.
     */
    public function index()
    {
        $dabrang = Dabrang::with('jebrang')
            ->orderBy('created_at', 'DESC')
            ->get();

        $dns2d = new DNS2D();

        foreach ($dabrang as $dbr) {
            // QR langsung arahkan ke route detail barang berdasarkan kode_barang
            $dbr->qrcode = $dns2d->getBarcodeHTML(
                route('dabrangs.show', $dbr->kode_barang),
                'QRCODE',
                5,
                5
            );
        }

        return view('dabrangs.index', compact('dabrang'));
    }

    /**
     * Form tambah data barang.
     */
    public function create()
    {
        $jebrangs = Jebrang::all();
        return view('dabrangs.create', compact('jebrangs'));
    }

    /**
     * Simpan data barang baru.
     * Kode barang dibuat otomatis (format: B_0001, B_0002, dst)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jebrang_id'  => 'required|exists:jebrangs,id',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil kode barang terakhir
        $lastBarang = Dabrang::orderBy('id', 'DESC')->first();

        // Generate kode baru
        if ($lastBarang) {
            // Ambil angka dari kode terakhir, misal: B_0003 → 3
            $lastNumber = (int) str_replace('B_', '', $lastBarang->kode_barang);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format jadi B_0001
        $kodeBaru = 'B_' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // Ambil data form
        $data = $request->all();
        $data['kode_barang'] = $kodeBaru;

        // Upload foto kalau ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_barang', $filename);
            $data['foto'] = $filename;
        }

        Dabrang::create($data);

        return redirect()->route('dabrangs')
            ->with('success', 'Data Barang berhasil ditambahkan dengan kode: ' . $kodeBaru);
    }

    /**
     * Detail barang berdasarkan kode_barang (bukan id).
     */
    public function show($kode_barang)
    {
        $dabrang = Dabrang::where('kode_barang', $kode_barang)
            ->with('jebrang')
            ->firstOrFail();

        return view('dabrangs.show', compact('dabrang'));
    }

    /**
     * Form edit data barang.
     */
    public function edit($id)
    {
        $dabrang  = Dabrang::findOrFail($id);
        $jebrangs = Jebrang::all();

        return view('dabrangs.edit', compact('dabrang', 'jebrangs'));
    }

    /**
     * Update data barang.
     */
    public function update(Request $request, $id)
    {
        $dabrang = Dabrang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:dabrangs,kode_barang,' . $dabrang->id,
            'nama_barang' => 'required|string|max:255',
            'jebrang_id'  => 'required|exists:jebrangs,id',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($dabrang->foto && Storage::exists('public/foto_barang/' . $dabrang->foto)) {
                Storage::delete('public/foto_barang/' . $dabrang->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_barang', $filename);
            $data['foto'] = $filename;
        } else {
            $data['foto'] = $dabrang->foto;
        }

        $dabrang->update($data);

        return redirect()->route('dabrangs')
            ->with('success', 'Data Barang berhasil diperbarui.');
    }

    /**
     * Hapus data barang.
     */
    public function destroy($id)
    {
        $dabrang = Dabrang::findOrFail($id);

        if ($dabrang->foto && Storage::exists('public/foto_barang/' . $dabrang->foto)) {
            Storage::delete('public/foto_barang/' . $dabrang->foto);
        }

        $dabrang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Barang berhasil dihapus.'
        ]);
    }
}