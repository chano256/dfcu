<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class CustomerTest extends TestCase
{
    use DatabaseTransactions; // reverts all changes added to the db

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cannot_show_loans_if_account_does_not_exists()
    {
        // login
        // $this->login();

        $faker = Faker::create();

        // create an account number not in the db
        do {
            $number = $faker->numberBetween(10000000000);
        } while (Account::whereNumber($number)->first());
        
        $response = $this->getJson(route('customer.account.loans.show', ['number' => $number]));
        // dd($response->__toString());
        $response->assertStatus(422);
    }
}
