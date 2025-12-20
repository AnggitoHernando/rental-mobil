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
        Schema::create('car_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->enum('price_type', ['daily', 'weekly', 'monthly']);
            $table->decimal('bruto', 12, 2);
            $table->decimal('disc', 12, 2);
            $table->decimal('netto', 12, 2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('car_prices');
    }
};
