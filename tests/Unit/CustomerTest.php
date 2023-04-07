<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Models\Loan;
use App\Traits\SqlTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class CustomerTest extends TestCase
{
    use DatabaseTransactions, SqlTrait; // reverts all changes added to the db

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

        // create an account number with 10 digits not in the db
        do {
            $number = $faker->numberBetween(10000000000);
        } while (Account::whereNumber($number)->first());

        $response = $this->getJson(route('customer.account.loans.show', ['number' => $number]));
        // dd($response->__toString());
        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_account_number_passed_in_url_throws_exception()
    {
        // login
        // $this->login();

        $faker = Faker::create();

        // create an account number with less than 10 digits
        $number = $faker->numberBetween(1, 100000000);

        $response = $this->getJson(route('customer.account.loans.show', ['number' => $number]));
        $response->assertStatus(411);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_get_outstanding_loans_for_requested_account_number()
    {
        // login
        // $this->login();

        $account = Account::factory()->create();
        Loan::factory(2)->create(['customer_id' => $account->customer_id]);

        $response = $this->getJson(route('customer.account.loans.show', ['number' => $account->number]));
        $response->assertStatus(200);
        $response->assertJsonStructure($this->getLoanStructure());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_outstanding_sql()
    {
        $faker = Faker::create();
        $alias = $faker->boolean;

        $sql = "(loans.amount - abs((select IFNULL(sum(debit_credit_amount), 0) from loan_ledger as l where l.loan_id = loans.id)))";
        $sql .= $alias ? " as outstanding_amount" : "  > 0";

        $this->assertSame($sql, $this->outstandingSql($alias));
    }

    /**
     * Gets structure of the loan resource with a minimum of 4 fields
     *
     */
    private function getLoanStructure(): array
    {
        return ["data" => [0 => [
            "id",  "loan_number",  "disbursement_date",  "disbursed_amount",  "outstanding_amount",  "status",  "customer_name",  "phone"
        ]]];
    }
}
