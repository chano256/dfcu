<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * Get loans for a customer
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class); // customer should not have loan id column
    }

    /**
     * Get accounts for a customer
     */
    public function account(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
