<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurations')->insert([
            'nama_konfigurasi' => 'no-image',
            'type' => 'image',
            'value' => 'config/no-image.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
