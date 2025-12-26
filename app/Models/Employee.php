<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'jabatan',
        'divisi',
        'telp',
        'alamat',
        'user_id', // Foreign key ke tabel users
    ];
    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
