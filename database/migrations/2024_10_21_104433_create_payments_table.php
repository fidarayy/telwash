<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');  // Primary key dengan auto_increment
        $table->unsignedBigInteger('user_id');  // Foreign key ke tabel Users
        $table->enum('payment_method', ['qris', 'bank_transfer', 'e_wallet']);
        $table->decimal('amount', 10, 2);
        $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
        
        // Foreign key merujuk ke 'user_id' di tabel 'users'
        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
    });    
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }    
};
