<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class LoanFactory extends Factory
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
            'amount' => $faker->numberBetween(50000, 1000000),
            'date' => $faker->date(),
            'status' => $faker->randomElement(['outstanding', 'closed']),
            'customer_id' => Customer::factory()->hasAccount()->create()->id
        ];
    }
}
