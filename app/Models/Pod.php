<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pod extends Model
{
    use HasFactory;

    protected $table = 'pods';

    protected $fillable = [
    'kode_auto',
    'kode_manual',
    'nomor_pod',
    'tanggal',
    'jenis_pod',
    'kategori_perawatan',
    'tipe_pod',
    'dibuat_oleh',
    'departemen',
    'lokasi',
    'daftar_pekerjaan',
    'uraian',
    'kode_transaksi',
    'lampiran',
];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Buat kode otomatis (misal: POD-001)
     */
    public static function generateKodeAuto()
    {
        $lastPod = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastPod ? intval(substr($lastPod->kode_auto, -3)) + 1 : 1;

        return 'POD-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Gabungkan kode_auto dan kode_manual jadi nomor_pod
     */
    public static function generateNomorPod($kodeAuto, $kodeManual)
    {
        return $kodeAuto . '-' . $kodeManual;
    }

    /**
     * Relasi ke tabel Lapok (laporan keluar)
     */
    public function lapok()
    {
        return $this->hasMany(Lapok::class, 'kode_pod', 'nomor_pod');
    }
}
