<?php

namespace App\Imports\Sheets;

use App\Patient\PatientRecordMedication;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PatientMedicationImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            $value = $row->toArray();
            $record = PatientRecordMedication::find($value['id']);
            // dump($record);
            if ($record) {
                $record->update($value);
            }else{
                PatientRecordMedication::create($value);
            }
        }
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
