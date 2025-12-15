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
        Schema::create('car_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->enum('expense_type', ['service', 'oli', 'perbaikan']);
            $table->string('description')->nullable();
            $table->decimal('amount', 12, 2);
            $table->date('expense_date');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('car_expenses');
    }
};
