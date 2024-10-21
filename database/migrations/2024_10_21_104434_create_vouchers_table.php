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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id('voucher_id');  // Primary key dengan auto_increment
            $table->string('code')->unique();  // Kode voucher yang unik
            $table->decimal('discount', 5, 2);  // Diskon
            $table->timestamp('valid_from')->default(DB::raw('CURRENT_TIMESTAMP'));  // Nilai default waktu saat ini
            $table->timestamp('valid_until')->default(DB::raw('CURRENT_TIMESTAMP'));  // Nilai default waktu saat ini
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
