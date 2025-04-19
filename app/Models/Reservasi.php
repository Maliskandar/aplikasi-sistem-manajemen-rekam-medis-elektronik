<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_customer',
        'id_kucing',
        'id_kandang',
        'status',
        'status_pembayaran',
        'tanggal_reservasi',
        'tanggal_selesai',
        'tanggal_pembayaran',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function kucing()
    {
        return $this->belongsTo(Kucing::class, 'id_kucing', 'id_kucing');
    }

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }
}