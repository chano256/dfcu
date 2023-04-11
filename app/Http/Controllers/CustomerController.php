<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanResource;
use App\Models\AuditTrail;
use App\Services\CustomerService;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerController extends Controller
{
    protected $customer;

    /**
     * Gets customer service methods from CustomerService
     */
    public function __construct(CustomerService $customer)
    {
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

    /**
     * Endpoint that provides a view of the APIs performance
     * i.e. number of requests, number of failed validations,
     * number of positive requests (at least one loan) and number of negative requests (zero outstanding loans).
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getApiPerformance()
    {
        $audit = AuditTrail::first();
        return response($audit->toArray());
    }
}
