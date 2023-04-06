<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'phone' => $faker->phoneNumber,
            'status' => $faker->boolean
        ];
    }

    /**
     * Indicates that the customer is active
     */
    public function active(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 1,
            ];
        });
    }
}
