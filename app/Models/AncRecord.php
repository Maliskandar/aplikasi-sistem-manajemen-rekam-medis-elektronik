<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AncRecord extends Model
{
    protected $fillable = [
        'patient_service_id',
        'hpht',
        'keluhan_saat_ini',
        'riwayat_kehamilan',
        'riwayat_persalinan',
        'riwayat_abortus',
        'riwayat_penyakit_keluarga',
        'bmi',
        'tekanan_darah',
        'tinggi_fundus',
        'denyut_janin',
        'lingkar_lengan_atas',
        'berat_badan',
        'tinggi_badan',
        'catatan',
    ];

    public function service()
    {
        return $this->belongsTo(PatientService::class, 'patient_service_id');
    }

    public function ancRecord()
    {
        return $this->hasOne(AncRecord::class, 'patient_service_id', 'patient_service_id');
    }

    public function patientService()
    {
        return $this->belongsTo(PatientService::class, 'patient_service_id');
    }


}