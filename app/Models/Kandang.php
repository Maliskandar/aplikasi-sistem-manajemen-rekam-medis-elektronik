<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    use HasFactory;

    protected $table = 'kandang';
    protected $primaryKey = 'id_kandang';

    protected $fillable = [
        'ukuran',
        'ketersediaan',
    ];
}