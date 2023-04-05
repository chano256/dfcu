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

Route::group( // incase of additional route groups
    ['prefix' => 'customer'],
    function () {
        Route::get('/account/{number}/loans', [CustomerController::class, 'show'])->name('customer.account.show.loans');
    }
);
