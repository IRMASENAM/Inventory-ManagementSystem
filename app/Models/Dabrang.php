<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dabrang extends Model
{
    use HasFactory;

    protected $table = 'dabrangs';

    protected $fillable = [
        'kode_barang',
        'foto',
        'nama_barang',
        'jebrang_id',
        'barcode', // tambahan kolom barcode
    ];

    public function jebrang()
    {
        return $this->belongsTo(Jebrang::class, 'jebrang_id');
    }
}