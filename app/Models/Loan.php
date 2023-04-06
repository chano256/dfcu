<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * Get Customer for loan
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
