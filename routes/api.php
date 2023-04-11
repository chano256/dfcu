<?php

use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('request.logger')->group(function () {
        Route::get('customer/account/{number}/loans', [CustomerController::class, 'showLoans'])
        ->middleware('validate.account.number')
        ->name('customer.account.loans.show');
    });

    Route::get('/performance', [CustomerController::class, 'getApiPerformance'])->name('performance');
});
