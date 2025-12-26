<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangMasukExport;
use App\Exports\BarangKeluarExport;

class LaporanController extends Controller
{
    // ----------------------
    // Laporan Barang Masuk
    // ----------------------
    public function barangMasuk(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = DB::table('barams')
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
            );

        if ($bulan && $tahun) {
            $query->whereMonth('barams.tgl_masuk', $bulan)
                  ->whereYear('barams.tgl_masuk', $tahun);
        } elseif ($tahun) {
            $query->whereYear('barams.tgl_masuk', $tahun);
        }

        $LaporanMasuk = $query->orderBy('barams.tgl_masuk', 'desc')->get();

        return view('laporan.masuk', compact('LaporanMasuk', 'bulan', 'tahun'));
    }

    public function exportBarangMasukPDF(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = DB::table('barams')
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
            );

        if ($bulan && $tahun) {
            $query->whereMonth('barams.tgl_masuk', $bulan)
                  ->whereYear('barams.tgl_masuk', $tahun);
        } elseif ($tahun) {
            $query->whereYear('barams.tgl_masuk', $tahun);
        }

        $LaporanMasuk = $query->orderBy('barams.tgl_masuk', 'desc')->get();

        $pdf = Pdf::loadView('laporan.pdf_masuk', compact('LaporanMasuk', 'bulan', 'tahun'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang-masuk.pdf');
    }

    public function exportBarangMasukExcel()
    {
        return Excel::download(new BarangMasukExport, 'laporan-barang-masuk.xlsx');
    }

    // ----------------------
    // Laporan Barang Keluar
    // ----------------------
    public function barangKeluar(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = DB::table('baraks')
            ->join('dabrangs', 'baraks.dabrang_id', '=', 'dabrangs.id')
            ->join('jebrangs', 'dabrangs.jebrang_id', '=', 'jebrangs.id')
            ->leftJoin('pods', 'baraks.pod_id', '=', 'pods.id')
            ->select(
                'baraks.no_transaksi',
                'baraks.tgl_keluar',
                'dabrangs.nama_barang',
                'jebrangs.nama_jenis',
                'baraks.jumlah_keluar',
                'pods.nomor_pod'
            );

        if ($bulan && $tahun) {
            $query->whereMonth('baraks.tgl_keluar', $bulan)
                  ->whereYear('baraks.tgl_keluar', $tahun);
        } elseif ($tahun) {
            $query->whereYear('baraks.tgl_keluar', $tahun);
        }

        // 🔹 Urutkan berdasarkan tanggal keluar (terbaru) lalu nomor POD (menaik)
        $LaporanKeluar = $query
            ->orderBy('baraks.tgl_keluar', 'desc')
            ->orderBy('pods.nomor_pod', 'asc')
            ->get();

        return view('laporan.keluar', compact('LaporanKeluar', 'bulan', 'tahun'));
    }

    public function exportBarangKeluarPDF(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $query = DB::table('baraks')
            ->join('dabrangs', 'baraks.dabrang_id', '=', 'dabrangs.id')
            ->join('jebrangs', 'dabrangs.jebrang_id', '=', 'jebrangs.id')
            ->leftJoin('pods', 'baraks.pod_id', '=', 'pods.id')
            ->select(
                'baraks.no_transaksi',
                'baraks.tgl_keluar',
                'dabrangs.nama_barang',
                'jebrangs.nama_jenis',
                'baraks.jumlah_keluar',
                'pods.nomor_pod'
            );

        if ($bulan && $tahun) {
            $query->whereMonth('baraks.tgl_keluar', $bulan)
                  ->whereYear('baraks.tgl_keluar', $tahun);
        } elseif ($tahun) {
            $query->whereYear('baraks.tgl_keluar', $tahun);
        }

        // 🔹 Urutkan juga di export berdasarkan tanggal + nomor POD
        $LaporanKeluar = $query
            ->orderBy('baraks.tgl_keluar', 'desc')
            ->orderBy('pods.nomor_pod', 'asc')
            ->get();

        $pdf = Pdf::loadView('laporan.pdf_keluar', compact('LaporanKeluar', 'bulan', 'tahun'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang-keluar.pdf');
    }

    public function exportBarangKeluarExcel()
    {
        return Excel::download(new BarangKeluarExport, 'laporan-barang-keluar.xlsx');
    }
}