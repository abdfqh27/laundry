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
            
            // UBAH ENUM STATUS - tambah processing, completed, picked_up, cancelled
            $table->enum('status', [
                'pending',      // Menunggu konfirmasi
                'processing',   // Sedang dikerjakan (ganti 'diproses')
                'completed',    // Selesai dikerjakan (ganti 'selesai')
                'picked_up',    // Sudah diambil customer (ganti 'diambil')
                'cancelled'     // Dibatalkan
            ])->default('pending');
            
            $table->enum('payment_status', ['unpaid', 'paid', 'pending'])->default('unpaid');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->date('pickup_date')->nullable();
            $table->date('delivery_date')->nullable();
            
            // UBAH ke foreignId supaya lebih proper
            $table->foreignId('karyawan_id')->nullable()->constrained('users')->onDelete('set null');
            
            // TAMBAH completed_at untuk tracking kapan order selesai
            $table->timestamp('completed_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};