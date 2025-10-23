<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'diproses', 'selesai', 'diambil'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'pending'])->default('unpaid');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->date('pickup_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('karyawan_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};