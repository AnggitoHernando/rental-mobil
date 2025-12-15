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
        Schema::create('booking_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_type', ['dp', 'pelunasan', 'deposit']);
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['cash', 'transfer']);
            $table->date('payment_date');
            $table->enum('status', ['paid', 'pending']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('booking_payments');
    }
};
