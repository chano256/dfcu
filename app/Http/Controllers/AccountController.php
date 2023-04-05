<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    /**
     * Shows a single account for a customer
     */
    public function show(Request $request, $number): ResourceCollection
    {
        dd($request);
        Account::whereNumber($number)->findOrFail();
        dd('end');
        return ResourceCollection::collection([]);
    }
}
