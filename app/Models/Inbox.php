<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $fillable = [
        'title',
        'message',
        'patient_service_id',
        'anc_record_id', // tambahkan ini
        'is_read',
    ];

    public function ancRecord()
    {
        return $this->belongsTo(AncRecord::class);
    }

}