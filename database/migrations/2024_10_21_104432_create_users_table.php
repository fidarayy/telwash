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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->autoIncrement();  // Primary key
            $table->string('name', 255);
            $table->string('phone_number', 15)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->enum('role', ['kasir', 'user']);
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->timestamps();
        });        
    }    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }    
};
