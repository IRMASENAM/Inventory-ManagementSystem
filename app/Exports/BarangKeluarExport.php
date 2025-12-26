<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangKeluarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('baraks')
            ->join('dabrangs', 'baraks.dabrang_id', '=', 'dabrangs.id')
            ->join('jebrangs', 'dabrangs.jebrang_id', '=', 'jebrangs.id')
            ->select(
                'baraks.no_transaksi',
                'baraks.tgl_keluar',
                'dabrangs.nama_barang',
                'jebrangs.nama_jenis',
                'baraks.jumlah_keluar',
                'baraks.keterangan'
            )
            ->orderBy('baraks.tgl_keluar', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No Transaksi',
            'Tanggal Keluar',
            'Nama Barang',
            'Jenis Barang',
            'Jumlah Keluar',
            'Keterangan'
        ];
    }
}