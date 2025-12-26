<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapok extends Model
{
    use HasFactory;

    protected $table = 'lapoks'; // pastikan nama tabel di migration sesuai

    protected $fillable = [
        'tgl_keluar',
        'no_transaksi',
        'dabrang_id',
        'jebrang_id',
        'jumlah_keluar',
        'keterangan',      // bisa diisi nomor POD nanti
        'kode_pod',        // opsional, jika kamu ingin relasi ke tabel pods
    ];

    /**
     * Relasi ke data barang (Dabrang)
     */
    public function dabrang()
    {
        return $this->belongsTo(Dabrang::class, 'dabrang_id');
    }

    /**
     * Relasi ke jenis barang (Jebrang)
     */
    public function jebrang()
    {
        return $this->belongsTo(Jebrang::class, 'jebrang_id');
    }

    /**
     * Relasi opsional ke tabel POD (untuk menghubungkan transaksi dengan POD tertentu)
     */
    public function pod()
    {
        return $this->belongsTo(Pod::class, 'kode_pod', 'nomor_pod');
    }
}
