<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Loan;
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

        do {
            $number = $faker->regexify('[0-9A-Za-z]{10}');
        } while (Loan::whereNumber($number)->first());

        return [
            'amount' => $faker->numberBetween(50000, 1000000),
            'number' => strtoupper($number),
            'date' => $faker->date(),
            'status' => $faker->randomElement(['outstanding', 'closed']),
            'customer_id' => Customer::factory()->hasAccount()->create()->id
        ];
    }
}
