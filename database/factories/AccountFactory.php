<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
        return [
            'number' => $faker->numberBetween(10000000000),
            'status' => $faker->boolean,
            'customer_id' => Customer::factory()->create()->id,
        ];
    }
}
