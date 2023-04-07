<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class LoanLedgerFactory extends Factory
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
            'loan_id' => Loan::factory()->create()->id,
            'amount' => $faker->numberBetween(5000, 50000),
            'date' => date('Y-m-d'),
            'type' => $faker->randomElement(['repayment', 'refund', 'write_off'])
        ];
    }
}
