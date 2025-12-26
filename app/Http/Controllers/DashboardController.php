<?php

namespace App\Http\Controllers;

use App\Models\Employee;   // Pegawai
use App\Models\Supplier;   // Supplier
use App\Models\Dabrang;    // Barang
use App\Models\Baram;      // Barang masuk
use App\Models\Barak;      // Barang keluar
use App\Models\Jebrang;    // Jenis barang
use App\Models\Sabrang;    // Satuan barang
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk cards
        $totalPegawai        = Employee::count();
        $totalSupplier       = Supplier::count();
        $totalBarang         = Dabrang::count();
        $totalBarangMasuk    = Baram::sum('jumlah_masuk');   // total unit masuk
        $totalBarangKeluar   = Barak::sum('jumlah_keluar');  // total unit keluar
        $totalSatuan         = Sabrang::count();
        $totalJenis          = Jebrang::count();

        // Jumlah transaksi (laporan)
        $totalLaporanMasuk   = Baram::count();   // banyaknya transaksi masuk
        $totalLaporanKeluar  = Barak::count();   // banyaknya transaksi keluar

        // Data chart: Barang Masuk & Keluar per bulan
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $labels = [];
        $jumlahMasuk = [];
        $jumlahKeluar = [];

        foreach (range(1, 12) as $i) {
            $labels[] = $bulanIndo[$i];

            $jumlahMasuk[]  = Baram::whereMonth('tgl_masuk', $i)->sum('jumlah_masuk');
            $jumlahKeluar[] = Barak::whereMonth('tgl_keluar', $i)->sum('jumlah_keluar');
        }

        // Data transaksi terbaru (opsional)
        $transaksiTerbaru = Baram::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPegawai',
            'totalSupplier',
            'totalBarang',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'totalSatuan',
            'totalJenis',
            'totalLaporanMasuk',
            'totalLaporanKeluar',
            'labels',
            'jumlahMasuk',
            'jumlahKeluar',
            'transaksiTerbaru'
        ));
    }
}