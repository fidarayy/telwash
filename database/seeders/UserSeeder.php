<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Generate data dummy untuk users
        DB::table('users')->insert([
            [
                'name' => 'Admin Kasir',
                'phone_number' => '081234567895',
                'email' => 'kasir@example.com',
                'password' => Hash::make('password123'), // Password terenkripsi
                'role' => 'kasir',
                'balance' => 100000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Regular User',
                'phone_number' => '081234567896',
                'email' => 'user@example.com',
                'password' => Hash::make('userpassword'), // Password terenkripsi
                'role' => 'user',
                'balance' => 50000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Alice User',
                'phone_number' => '081234567897',
                'email' => 'alice@example.com',
                'password' => Hash::make('alicepass'), // Password terenkripsi
                'role' => 'user',
                'balance' => 75000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bob Kasir',
                'phone_number' => '081234567898',
                'email' => 'bob.kasir@example.com',
                'password' => Hash::make('bobkasirpass'), // Password terenkripsi
                'role' => 'kasir',
                'balance' => 150000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
