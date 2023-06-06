<?php

use App\Http\Controllers\CurrenciesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PaymentMethodsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/payment-methods', [PaymentMethodsController::class, 'api_index'])->name('payment-methods.api-index');

Route::get('/currencies', [CurrenciesController::class, 'api_index'])->name('currencies.api-index');