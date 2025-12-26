<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::orderBy('created_at', 'DESC')->get();
        return view('suppliers.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 🔹 Ambil supplier terakhir berdasarkan ID
        $lastSupplier = Supplier::orderBy('id', 'desc')->first();

        // 🔹 Tentukan nomor urut berikutnya
        if ($lastSupplier) {
            $lastNumber = (int) substr($lastSupplier->kode_supplier, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // 🔹 Format kode baru, misal: SPR-0001
        $newKode = 'SPR-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return view('suppliers.create', compact('newKode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // 🔹 Jika ada foto supplier
        if ($request->hasFile('foto_supplier')) {
            $file = $request->file('foto_supplier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_supplier', $filename);
            $data['foto_supplier'] = $filename;
        }

        Supplier::create($data);
        return redirect()->route('suppliers')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $data = $request->all();

        // 🔹 Jika ada foto baru diupload
        if ($request->hasFile('foto_supplier')) {
            // Hapus foto lama
            if ($supplier->foto_supplier && file_exists(storage_path('app/public/foto_supplier/' . $supplier->foto_supplier))) {
                unlink(storage_path('app/public/foto_supplier/' . $supplier->foto_supplier));
            }

            // Simpan foto baru
            $file = $request->file('foto_supplier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_supplier', $filename);
            $data['foto_supplier'] = $filename;
        } else {
            $data['foto_supplier'] = $supplier->foto_supplier;
        }

        $supplier->update($data);
        return redirect()->route('suppliers')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->foto_supplier) {
            Storage::delete('public/foto_supplier/' . $supplier->foto_supplier);
        }

        $supplier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data supplier berhasil dihapus.'
        ]);
    }
}