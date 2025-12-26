<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangMasukExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('barams')
            ->join('dabrangs', 'barams.dabrang_id', '=', 'dabrangs.id')
            ->join('suppliers', 'barams.supplier_id', '=', 'suppliers.id')
            ->join('jebrangs', 'dabrangs.jebrang_id', '=', 'jebrangs.id')
            ->select(
                'barams.no_transaksi',
                'barams.tgl_masuk',
                'dabrangs.nama_barang',
                'jebrangs.nama_jenis',
                'suppliers.nama_supplier',
                'barams.jumlah_masuk',
                'barams.harga_beli',
                DB::raw('(barams.jumlah_masuk * barams.harga_beli) as total_harga')
            )
            ->orderBy('barams.tgl_masuk', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No Transaksi',
            'Tanggal Masuk',
            'Nama Barang',
            'Jenis Barang',
            'Supplier',
            'Jumlah',
            'Harga Beli',
            'Total Harga'
        ];
    }
}