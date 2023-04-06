<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLoanIdentifier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('number', 10)->unique();
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
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('number');
        });

        DB::statement("ALTER TABLE loans DROP CONSTRAINT chk_loan_number;");
    }
}
