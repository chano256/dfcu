<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Services\CustomerService;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(CustomerService $customer) {
        $this->customer = $customer;
    }
    /**
     * Shows loans for attached to a customers account
     */
    public function showLoans(string $number): JsonResource
    {
        $loans = $this->customer->getOutstandingLoans($number);
        return LoanResource::collection($loans);
    }
}
