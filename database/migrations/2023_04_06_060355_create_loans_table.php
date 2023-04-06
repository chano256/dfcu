<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 12, 2, true);
            $table->string('number', 10)->unique();
            $table->date('date');
            $table->enum('status', ['outstanding', 'closed'])->default('outstanding');
            $table->unsignedBigInteger('customer_id');

            $table->foreign('customer_id', 'fk_loan_customer_id')->references('id')->on('customers');
        });

        DB::statement("ALTER TABLE loans ADD CONSTRAINT chk_loan_number CHECK (LENGTH(number) = 10);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
