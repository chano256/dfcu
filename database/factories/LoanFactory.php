<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

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

        $loan_number = strtoupper($number);
        $date = $faker->date();
        $customer = Customer::factory()->hasAccount()->create();

        Log::info("Creating Loan {$loan_number} for customer {$customer->fullname}");
        return [
            'amount' => $faker->numberBetween(50000, 1000000),
            'number' => $loan_number,
            'date' => $date,
            'customer_id' => $customer->id
        ];
    }
}
