<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');  // Primary key dengan auto_increment
            $table->unsignedBigInteger('transaction_id');  // Foreign key ke tabel Transactions
            $table->enum('status', ['diterima', 'diproses', 'selesai', 'diambil']);  // Status pesanan laundry
            $table->enum('payment_status', ['success', 'pending', 'failed'])->default('pending');  // Status pembayaran, default 'pending'
            $table->timestamp('finished_at')->nullable();  // Kolom finished_at untuk tanggal selesai
            $table->timestamps();  // Kolom created_at dan updated_at otomatis
    
            // Foreign key constraint dengan onDelete cascade
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
