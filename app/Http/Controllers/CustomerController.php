<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Account;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Shows loans for attached to a customers account
     */
    public function showLoans(string $number): JsonResource
    {
        $account = Account::whereNumber($number)->first();
        abort_unless($account, Response::HTTP_UNPROCESSABLE_ENTITY, 'Account does not exists.');

        $loans = $account->customer->loans;
        abort_unless($loans, Response::HTTP_UNPROCESSABLE_ENTITY, 'Customer does not have loans.');

        return LoanResource::collection($loans);
    }
}
