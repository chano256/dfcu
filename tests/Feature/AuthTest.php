<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Loan;
use App\Models\User;
use App\Traits\SqlTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;
use Laravel\Passport\Passport;

class AuthTest extends TestCase
{
    use DatabaseTransactions; // reverts all changes added to the db

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registered_user_can_login()
    {
        $credentials = [
            'name' => 'testing',
            'email' => env('TEST_USER_EMAIL'),
            'password' => env('TEST_USER_PASSWORD'),
            'password_confirmation' => env('TEST_USER_PASSWORD')
        ];

        // create user
        $register = $this->postJson(route('register', $credentials));
        $register->assertStatus(201);

        // attempt to login with user credentials
        $response = $this->postJson(route('login', $credentials));
        $response->assertStatus(200);
        $response->assertJsonStructure($this->getLoginStructure());
    }


    /**
     * Gets structure of the loan resource with a minimum of 4 fields
     *
     */
    private function getLoginStructure(): array
    {
        return ["user",  "token_type",  "access_token"];
    }
}
