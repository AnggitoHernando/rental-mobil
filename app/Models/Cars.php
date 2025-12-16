<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $fillable = [
        'kode_mobil',
        'brand',
        'model',
        'tahun',
        'no_polisi',
        'warna',
        'kapasitas',
        'status_aktif'
    ];
}
