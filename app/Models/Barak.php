<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barak extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tgl_keluar',
        'dabrang_id',
        'jumlah_keluar',
        'keterangan',
        'pod_id', // tambahkan biar bisa disimpan
    ];

    /**
     * Relasi ke tabel Dabrang (barang)
     */
    public function dabrang()
    {
        return $this->belongsTo(\App\Models\Dabrang::class, 'dabrang_id');
    }

    /**
     * Relasi ke tabel POD
     * Barang keluar terkait dengan satu POD
     */
    public function pod()
    {
        return $this->belongsTo(\App\Models\Pod::class, 'pod_id');
    }
}