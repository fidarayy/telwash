<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id('voucher_id');  // Primary key dengan auto_increment
            $table->string('code')->unique();  // Kode voucher yang unik
            $table->decimal('discount', 5, 2);  // Diskon dalam format persentase (0.00 hingga 100.00)
            $table->decimal('min_transaction', 10, 2);  // Minimum transaksi untuk menggunakan voucher
            $table->decimal('max_discount', 10, 2);  // Potongan maksimal dari voucher
            $table->integer('usage_limit')->default(1);  // Limit penggunaan voucher
            $table->string('product')->nullable();  // Produk terkait (opsional, berupa string)
            $table->boolean('status')->default(true);  // Status voucher (true = aktif, false = tidak aktif)
            $table->timestamp('valid_from')->default(DB::raw('CURRENT_TIMESTAMP'));  // Waktu mulai berlaku
            $table->timestamp('valid_until')->nullable();  // Waktu berakhir (nullable jika tidak terbatas)
            $table->timestamps();  // created_at dan updated_at otomatis
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');  // Menghapus tabel vouchers
    }
};
