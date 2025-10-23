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
            
            // Alamat Penjembutan & Pengiriman
            $table->string('pickup_address');
            $table->string('pickup_phone')->nullable();
            $table->text('pickup_notes')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_phone')->nullable();
            $table->text('delivery_notes')->nullable();
            
            // Order Information
            $table->text('notes')->nullable();
            
            // Status Order - dengan tracking lengkap
            $table->enum('status', [
                'pending',           // Menunggu dikonfirmasi
                'confirmed',         // Sudah dikonfirmasi
                'picked_up',         // Sudah dijemput
                'processing',        // Sedang diproses
                'ready',            // Siap diambil/dikirim
                'delivered',        // Sudah dikirim/diambil
                'completed',        // Selesai
                'cancelled'         // Dibatalkan
            ])->default('pending');
            
            $table->enum('payment_status', ['unpaid', 'paid', 'pending'])->default('unpaid');
            $table->decimal('total_amount', 10, 2)->default(0);
            
            // Tanggal penting
            $table->date('pickup_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            
            // Karyawan yang handling
            $table->foreignId('karyawan_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};