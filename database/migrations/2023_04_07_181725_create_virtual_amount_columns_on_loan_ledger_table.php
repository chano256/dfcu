<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualAmountColumnsOnLoanLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_ledger', function (Blueprint $table) {
            $table->decimal('debit_credit_amount', 12, 2)->virtualAs("IF((type != 'refund'), 0 - amount, amount)");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_ledger', function (Blueprint $table) {
            $table->dropColumn('debit_credit_amount');
        });
    }
}
