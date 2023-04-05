<?php

use App\Http\Controllers\AccountController;
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

Route::group(
    ['prefix' => 'accounts'],
    function () {
        Route::get('/{number}', [AccountController::class, 'show'])
            ->where('number', '^\d{10}$') // only accepts 10 digits
            ->name('accounts.show');
    }
);
