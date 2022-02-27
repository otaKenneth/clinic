<?php

namespace App\Patient;

use Illuminate\Database\Eloquent\Model;

class PatientPastMedication extends Model
{
    //
    protected $guarded = [];

    public function record()
    {
        return $this->belongsTo(PatientRecord::class);
    }
}
