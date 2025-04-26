<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'patient_service_id',
        'nama_obat',
        'dosis',
        'aturan_pakai',
        'catatan',
    ];

    public function service()
    {
        return $this->belongsTo(PatientService::class, 'patient_service_id');
    }
}