<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Loan;
use Illuminate\Http\Response;

class CustomerService
{
    public function getOutstandingLoans($account_number)
    {
        $account = Account::whereNumber($account_number)->first();
        abort_unless($account, Response::HTTP_UNPROCESSABLE_ENTITY, 'Account does not exist.');

        // Get outstanding(current) loans
        $loans = Loan::outstanding()->with('customer')->where(['customer_id' => $account->customer_id])->get();

        abort_unless($loans, Response::HTTP_UNPROCESSABLE_ENTITY, 'No loans found.');

        return $loans;
    }
}
