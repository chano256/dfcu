<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Http\Response;

class CustomerService
{
    public function getOutstandingLoans($account_number)
    {
        $account = Account::whereNumber($account_number)->first();
        abort_unless($account, Response::HTTP_UNPROCESSABLE_ENTITY, 'Account does not exist.');

        // Get outstanding(current) loans
        $loans = $account->customer->loans;
        abort_unless($loans, Response::HTTP_UNPROCESSABLE_ENTITY, 'No loans found.');

        return $loans;
    }
}