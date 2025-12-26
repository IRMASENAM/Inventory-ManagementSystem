<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentWeek extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_id', 'week_number', 'status'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}