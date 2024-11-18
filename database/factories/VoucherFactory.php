<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    protected $model = Voucher::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->lexify('VOUCHER????'),  // Unique voucher code
            'discount' => $this->faker->numberBetween(5, 50),  // Random discount between 5% and 50%
            'min_transaction' => $this->faker->numberBetween(100000, 500000),  // Random min transaction
            'max_discount' => $this->faker->numberBetween(10000, 100000),  // Random max discount
            'usage_limit' => $this->faker->numberBetween(1, 100),  // Random usage limit
            'valid_from' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),  // Valid from
            'valid_until' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),  // Valid until
            'status' => $this->faker->randomElement([1, 0]),  // Random status (1 or 0)
        ];
    }
}
