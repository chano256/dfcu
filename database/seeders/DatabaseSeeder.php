<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // we assume the other endpoints at the bank created the customers
        // therefore this API is to query the customer loan status

        User::factory()->create();
        Loan::factory(10)->create(); // create multiple loans
    }
}
