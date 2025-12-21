<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Car extends Model
{
    use HasFactory;

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
    public function scopeFilter(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('kode_mobil', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhere('no_polisi', 'like', "%{$search}%")
                        ->orWhere('warna', 'like', "%{$search}%");
                });
            })

            ->when($request->from, function ($q, $from) {
                $q->whereDate('created_at', '>=', $from);
            })

            ->when($request->to, function ($q, $to) {
                $q->whereDate('created_at', '<=', $to);
            })

            ->when(
                $request->sort,
                function ($q, $sort) use ($request) {
                    $direction = $request->get('direction', 'asc');
                    $q->orderBy($sort, $direction);
                },
                function ($q) {
                    // default sorting
                    $q->latest();
                }
            );
    }

    public function images()
    {
        return $this->hasMany(CarImage::class, 'car_id')->where('cover', '0');
    }

    public function imageCover()
    {

        return $this->hasOne(CarImage::class)->where('cover', '1');
    }

    public function prices()
    {
        return $this->hasMany(CarPrice::class, 'car_id');
    }
}
