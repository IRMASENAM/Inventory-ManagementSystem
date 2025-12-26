<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Baram extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tgl_masuk',
        'supplier_id',
        'dabrang_id',   // ✅ ganti dari barang_id ke dabrang_id
        'jebrang_id',   // ✅ tambahkan karena memang ada di DB
        'jumlah_masuk',
        'harga_beli',
        'total_harga',
    ];

    // Relasi ke supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // Relasi ke barang (dabrangs)
    public function dabrang()
    {
        return $this->belongsTo(Dabrang::class, 'dabrang_id');
    }

    // Relasi langsung ke jenis barang
    public function jebrang()
    {
        return $this->belongsTo(Jebrang::class, 'jebrang_id');
    }

    // Mutator untuk format tanggal (input)
    public function setTglMasukAttribute($value)
    {
        if (is_string($value) && preg_match('/^\d{1,2} \w+ \d{4}$/', $value)) {
            $this->attributes['tgl_masuk'] = Carbon::createFromFormat('d F Y', $value)->format('Y-m-d');
        } else {
            $this->attributes['tgl_masuk'] = $value;
        }
    }

    // Accessor untuk format tanggal (output)
    public function getTglMasukAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d F Y') : null;
    }
}