<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate data dummy untuk transactions
        DB::table('transactions')->insert([
            [
                'customer_id' => 1,  // Ganti dengan ID customer yang valid
                'user_id' => 1,  // Ganti dengan ID user yang valid
                'service_type' => 'cuci saja',
                'weight' => 5.0,
                'price' => 50000.00,
                'payment_status' => 'lunas',
                'service_duration' => 3,
                'received_at' => Carbon::now(),
                'estimated_finish_at' => Carbon::now()->addDays(3),
                'finished_at' => Carbon::now()->addDays(3),
                'status' => 'selesai',
                'unit_type' => 'kilogram',
                'payment_method' => 'cash',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_id' => 2,
                'user_id' => 1,
                'service_type' => 'cuci + setrika',
                'weight' => 8.5,
                'price' => 85000.00,
                'payment_status' => 'belum lunas',
                'service_duration' => 5,
                'received_at' => Carbon::now(),
                'estimated_finish_at' => Carbon::now()->addDays(5),
                'finished_at' => null,
                'status' => 'diproses',
                'unit_type' => 'kilogram',
                'payment_method' => 'e_wallet',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_id' => 3,
                'user_id' => 2,
                'service_type' => 'express',
                'weight' => 2.0,
                'price' => 60000.00,
                'payment_status' => 'lunas',
                'service_duration' => 1,
                'received_at' => Carbon::now(),
                'estimated_finish_at' => Carbon::now()->addDay(),
                'finished_at' => Carbon::now()->addDay(),
                'status' => 'diambil',
                'unit_type' => 'satuan',
                'payment_method' => 'qris',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
