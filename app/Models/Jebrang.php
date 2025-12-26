<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jebrang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jenis', 'keterangan'];

    // Relasi ke Dabrang (barang dengan jenis ini)
    public function dabrangs()
    {
        return $this->hasMany(Dabrang::class, 'jebrang_id');
    }

    // Relasi ke Baram (opsional, kalau memang butuh langsung)
    public function barams()
    {
        return $this->hasMany(Baram::class, 'jebrang_id');
    }
}