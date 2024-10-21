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
        Schema::create('voucher_usage', function (Blueprint $table) {
            $table->id('usage_id');  // Primary key dengan auto_increment
            $table->unsignedBigInteger('user_id');  // Foreign key ke tabel Users
            $table->unsignedBigInteger('voucher_id');  // Foreign key ke tabel Vouchers
            $table->unsignedBigInteger('transaction_id');  // Foreign key ke tabel Transactions
            $table->timestamp('used_at')->default(DB::raw('CURRENT_TIMESTAMP'));  // Waktu voucher digunakan
        
            // Definisi foreign key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('voucher_id')->references('voucher_id')->on('vouchers')->onDelete('cascade');
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
        });              
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_usage');  // Menghapus tabel voucher_usage
    }
};
