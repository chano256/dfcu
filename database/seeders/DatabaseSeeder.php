<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        
        // \App\Models\User::factory(10)->create();
        Customer::factory(10)->create();
    }
}
