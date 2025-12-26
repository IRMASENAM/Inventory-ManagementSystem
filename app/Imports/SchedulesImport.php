<?php

namespace App\Imports;

use App\Models\Schedule;
use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchedulesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $equipment = Equipment::firstOrCreate(
            ['name' => $row['equipment'] ?? $row['Unnamed: 2']],
        );
        return new Schedule([
            'equipment_id' => $equipment->id,
            'week_number' => $row['week_number'] ?? 1,
            'activity' => $row['activity'] ?? null,
            'status' => 'pending',
        ]);
    }
}
