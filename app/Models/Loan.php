<?php

namespace App\Models;

use App\Traits\SqlTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory, SqlTrait;

    public $timestamps = false;

    /**
     * Get Customer for loan
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get outstanding loans
     * Outstanding loans if it loan still has a principal balance
     */
    public function scopeOutstanding($query)
    {
        return $query->select('loans.*')->selectRaw($this->outstandingSql(true))->whereRaw($this->outstandingSql());
    }
}
