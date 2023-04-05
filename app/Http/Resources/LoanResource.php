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
            'number' => $this->number,
            'date' => $this->date,
            'outstanding_amount' => $this->outstanding_amount,
            'status' => $this->status,
            'customer_name' => $customer->fullname,
            'customer_number' => $customer->number,
            'phone' => $customer->phone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
