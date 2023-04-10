<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        $customer = Customer::factory()->create();
        $number = $faker->numberBetween(10000000000);

        Log::info("Creating account {$number} for customer {$customer->fullname}");
        return [
            'number' => $number,
            'status' => $faker->boolean,
            'customer_id' => $customer->id,
        ];
    }
}
