<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_id',
        'price_type',
        'bruto',
        'disc',
        'netto',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
