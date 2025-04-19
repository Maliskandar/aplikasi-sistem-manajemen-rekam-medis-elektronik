<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kucing extends Model
{
    use HasFactory;

    protected $table = 'kucing';

    protected $primaryKey = 'id_kucing';

    protected $fillable = [
        'nama',
        'ras',
        'info_kesehatan',
        'id_customer',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_kucing', 'id_kucing');
    }
}