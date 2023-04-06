<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Get Customer for loan
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get account Number
     */
    public function getAccountNumberAttribute()
    {
        return $this->customer->account->first()->number;
    }

    // /**
    //  * Get outstanding loans
    //  * Outstanding loans if it loan still has a principal balance
    //  */
    // public function scopeOutstanding($query)
    // {
    //     return $query->select()->where($);
    // }
}
