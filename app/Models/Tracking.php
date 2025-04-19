<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'tracking';
    protected $primaryKey = 'id_tracking';

    protected $fillable = [
        'id_kucing',
        'laporan',
        'foto',
    ];

    public function kucing()
    {
        return $this->belongsTo(Kucing::class, 'id_kucing');
    }
}