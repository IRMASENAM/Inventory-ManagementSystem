<?php

namespace App\Imports;

use App\Models\Equipment;
use App\Models\EquipmentWeek;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class EquipmentsImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        // Buat data master equipment
        $equipment = Equipment::create([
            'name'     => $row[0] ?? null,   // Kolom A
            'location' => $row[1] ?? null,   // Kolom B
            'category' => $row[2] ?? null,   // Kolom C
        ]);

        // Simpan data per minggu (D - BB = 52 kolom)
        for ($i = 1; $i <= 52; $i++) {
            EquipmentWeek::create([
                'equipment_id' => $equipment->id,
                'week_number'  => $i,
                'status'       => $row[$i+2] ?? null, // kolom D = index 3
            ]);
        }
    }
}