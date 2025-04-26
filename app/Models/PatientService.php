<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientService extends Model
{
    protected $fillable = [
        'patient_id',
        'service_type',
        'queue_number',
        'queue_date',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ancRecord()
    {
        return $this->hasOne(AncRecord::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}