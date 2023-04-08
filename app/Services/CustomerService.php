<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Loan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    /**
     * Gets outstanding loans of a customer from provided account number
     */
    public function getOutstandingLoans(string $account_number): mixed
    {
        $account = Account::whereNumber($account_number)->first();
        abort_unless($account, Response::HTTP_UNPROCESSABLE_ENTITY, 'Account does not exist.');

        // Get outstanding(current) loans
        $loans = Loan::outstanding()->with('customer')->where(['customer_id' => $account->customer_id])->get();

        abort_unless($loans, Response::HTTP_UNPROCESSABLE_ENTITY, 'No loans found.');

        Log::info("Outstanding lans generated for account '{$account_number}'");

        return $loans;
    }
}
