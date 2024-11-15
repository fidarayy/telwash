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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');  // Primary key dengan auto_increment
            $table->unsignedBigInteger('customer_id');  // Foreign key ke tabel Customers
            $table->unsignedBigInteger('user_id');  // Foreign key ke tabel Users
            $table->enum('service_type', ['Cuci Saja', 'Cuci Dan Setrika', 'Express']);  // Jenis layanan
            $table->float('weight');  // Berat pakaian
            $table->decimal('price', 10, 2);  // Harga transaksi
            $table->enum('payment_status', ['Lunas', 'DP', 'Belum Dibayar']);  // Status pembayaran
            $table->integer('service_duration');  // Lama pengerjaan (hari)
            $table->timestamp('received_at')->default(DB::raw('CURRENT_TIMESTAMP'));  // Waktu pesanan diterima
            $table->timestamp('estimated_finish_at')->nullable();  // Estimasi waktu selesai (nullable)
            $table->timestamp('finished_at')->nullable();  // Waktu selesai sesungguhnya (nullable)
            $table->enum('status', ['Diterima', 'Diproses', 'Selesai', 'Diambil']);  // Status proses laundry
            $table->enum('unit_type', ['satuan', 'kilogram']);  // Jenis satuan atau kilogram
            $table->enum('payment_method', ['Cash', 'Qris', 'E_wallet']);  // Metode pembayaran
            $table->timestamps();  // created_at dan updated_at otomatis

            // Definisikan foreign key
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
