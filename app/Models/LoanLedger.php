<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLedger extends Model
{
    use HasFactory;

    protected $table = 'loan_ledger';
    public $timestamps = false;
}
