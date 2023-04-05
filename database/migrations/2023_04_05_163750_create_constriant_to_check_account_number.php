<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateConstriantToCheckAccountNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE customers ADD CONSTRAINT chk_customer_no_length CHECK(LENGTH(number) = 10);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE accounts DROP CONSTRAINT chk_account_no_length;");
    }
}
