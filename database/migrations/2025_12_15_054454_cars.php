<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mobil')->unique();
            $table->string('brand');
            $table->string('model');
            $table->year('tahun');
            $table->string('no_polisi')->unique();
            $table->string('warna')->nullable();
            $table->integer('kapasitas');
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
