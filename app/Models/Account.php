<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    /**
     * Get customer belonging to account
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
