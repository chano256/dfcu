<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('number', 10)->unique();
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            $table->foreign('customer_id', 'fk_account_customer_id')->references('id')->on('customers');
        });

        DB::statement("ALTER TABLE accounts ADD CONSTRAINT chk_account_no_length CHECK(LENGTH(number) = 10);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
