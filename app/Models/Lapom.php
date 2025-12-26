<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapom extends Model
{
    use HasFactory;

    protected $table = 'lapoms';
    protected $fillable = [
        'tgl_masuk',
        'no_transaksi',
        'supplier_id',
        'dabrang_id',
        'jumlah_masuk',
        'harga_beli',
        'total_harga',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function dabrang()
    {
        return $this->belongsTo(Dabrang::class, 'dabrang_id');
    }
}