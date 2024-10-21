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
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));  // Waktu update otomatis
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');  // Foreign key dengan ON DELETE CASCADE
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
