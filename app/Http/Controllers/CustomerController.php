<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Shows loans for attached to a customers account
     */
    public function showLoans(string $number): JsonResource
    {
        $customer = Customer::whereNumber($number)->first();
        abort_unless($customer, Response::HTTP_UNPROCESSABLE_ENTITY, "Action Failed, Account Does Not Exist");
        $loans = $customer->loans;

        return LoanResource::collection($loans);
    }
}
