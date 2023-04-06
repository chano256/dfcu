<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $customer = $this->customer;

        return [
            'id' => $this->id,
            'date' => $this->date,
            'disbursed_amount' => $this->amount,
            'outstanding_amount' => $this->outstanding_amount,
            'status' => $this->status,
            'customer_name' => $customer->fullname,
            'phone' => $customer->phone
        ];
    }
}
