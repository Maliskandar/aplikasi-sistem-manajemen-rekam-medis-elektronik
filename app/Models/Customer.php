<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class, 'id_customer', 'id');
    }

    protected $table = 'customer';

    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'nama',
        'info_kontak',
        'email',
    ];

    public function kucing()
    {
        return $this->hasMany(Kucing::class, 'id_customer');
    }
}