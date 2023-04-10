<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    /**
     * Gets outstanding loans of a customer from provided account number
     */
    public function getOutstandingLoans(string $account_number): Collection
    {
        $account = Account::whereNumber($account_number)->first();
        abort_unless($account, Response::HTTP_NOT_FOUND, 'Account not found.');

        // Get outstanding(current) loans
        $loans = Loan::outstanding()->with('customer')->where(['customer_id' => $account->customer_id])->get();

        abort_unless(($loans->count() > 0), Response::HTTP_NOT_FOUND, 'No loans found.');

        Log::info("Outstanding loans generated for account {$account_number}");

        return $loans;
    }
}
