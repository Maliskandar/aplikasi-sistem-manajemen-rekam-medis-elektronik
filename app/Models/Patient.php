<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'nik',
        'full_name',
        'phone',
        'birth_date',
        'gender',
        'marital_status',
        'address',
        'province',
        'city',
        'district',
        'sub_district',
        'postal_code',
        'insurance',
        'payment_type',
        'other_contacts',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'other_contacts' => 'array'
    ];

    public function services()
    {
        return $this->hasMany(\App\Models\PatientService::class);
    }

}