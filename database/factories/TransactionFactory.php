<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'user_id' => User::factory(),
            'service_type' => $this->faker->randomElement(['Cuci Saja', 'Cuci Dan Setrika', 'Express']), // Jenis Layanan
            'weight' => $this->faker->randomFloat(1, 1, 10),
            'price' => $this->faker->randomFloat(2, 5000, 100000),
            'payment_status' => $this->faker->randomElement(['Lunas', 'DP', 'Belum Dibayar']), // Metode Pembayaran
            'service_duration' => $this->faker->numberBetween(1, 7),
            'received_at' => Carbon::now(),
            'estimated_finish_at' => Carbon::now()->addDays(3),
            'finished_at' => null,
            'status' => $this->faker->randomElement(['Diterima', 'Diproses', 'Selesai', 'Diambil']), // Status
            'unit_type' => $this->faker->randomElement(['satuan', 'kilogram']),
            'payment_method' => $this->faker->randomElement(['cash', 'qris', 'e_wallet']),
        ];
    }
}
