<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Configuration extends Model
{
    protected $fillable = ['nama_konfigurasi', 'value', 'type'];
    public static function get($nama_konfigurasi, $default = null)
    {
        return Cache::rememberForever("config_{$nama_konfigurasi}", function () use ($nama_konfigurasi, $default) {
            $config = static::where('nama_konfigurasi', $nama_konfigurasi)->first();

            if (!$config) return $default;

            return $config->type === 'image'
                ? asset('storage/' . $config->value)
                : $config->value;
        });
    }
}
