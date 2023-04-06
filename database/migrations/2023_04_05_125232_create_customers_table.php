<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string("fullname", 60)->virtualAs("(concat(first_name,' ',last_name))");
            $table->integer('number', 10)->unique();
            $table->string('phone', 20)->unique();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE customers ADD CONSTRAINT chk_customer_no_length CHECK(LENGTH(number) = 10);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
