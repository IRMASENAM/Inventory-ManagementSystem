<?php

namespace App\Exports;

use App\Models\Pod;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PodsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pod::select('nomor_pod', 'tanggal', 'jenis_pod', 'kategori_perawatan', 'tipe_pod', 'departemen', 'dibuat_oleh')->get();
    }

    public function headings(): array
    {
        return ['Nomor POD', 'Tanggal', 'Jenis POD', 'Kategori', 'Tipe POD', 'Divisi', 'Dibuat Oleh'];
    }
}