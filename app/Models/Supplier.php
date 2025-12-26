<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'telp_supplier',
        'alamat_supplier',
        'email_supplier',
        'foto_supplier',
    ];
    public function barams()
    {
        return $this->hasMany(Baram::class);
    }
}
