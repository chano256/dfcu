<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('request.logger')->group(function () {
    Route::get('customer/account/{number}/loans', [CustomerController::class, 'showLoans'])
        ->middleware('validate.account.number')
        ->name('customer.account.loans.show');
});
