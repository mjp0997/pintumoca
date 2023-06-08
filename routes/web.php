<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        // POST
        Route::get('/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        // PUT
        // DELETE
    });

    Route::prefix('/offices')->group(function () {
        Route::get('/', [OfficesController::class, 'index'])->name('offices.index');
        Route::get('/create', [OfficesController::class, 'create'])->name('offices.create');
        Route::post('/', [OfficesController::class, 'store'])->name('offices.store');
        Route::get('/{id}', [OfficesController::class, 'show'])->name('offices.show');
        Route::get('/{id}/edit', [OfficesController::class, 'edit'])->name('offices.edit');
        Route::put('/{id}', [OfficesController::class, 'update'])->name('offices.update');
        Route::delete('/{id}', [OfficesController::class, 'destroy'])->name('offices.destroy');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
        Route::put('/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    });

    Route::prefix('/payment-methods')->group(function () {
        Route::get('/', [PaymentMethodsController::class, 'index'])->name('payment-methods.index');
        Route::get('/create', [PaymentMethodsController::class, 'create'])->name('payment-methods.create');
        Route::post('/', [PaymentMethodsController::class, 'store'])->name('payment-methods.store');
        Route::get('/{id}', [PaymentMethodsController::class, 'show'])->name('payment-methods.show');
        Route::get('/{id}/edit', [PaymentMethodsController::class, 'edit'])->name('payment-methods.edit');
        Route::put('/{id}', [PaymentMethodsController::class, 'update'])->name('payment-methods.update');
        Route::delete('/{id}', [PaymentMethodsController::class, 'destroy'])->name('payment-methods.destroy');
    });

    Route::prefix('/sales')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales.index');
        Route::get('/create', [SalesController::class, 'create'])->name('sales.create');
        Route::post('/', [SalesController::class, 'store'])->name('sales.store');
        Route::get('/{id}', [SalesController::class, 'show'])->name('sales.show');
        Route::get('/{id}/edit', [SalesController::class, 'edit'])->name('sales.edit');
        // PUT
        // DELETE
    });

    Route::prefix('/stocks')->group(function () {
        // Route::get('/', [PaymentMethodsController::class, 'index'])->name('stocks.index');
        // Route::get('/create', [PaymentMethodsController::class, 'create'])->name('stocks.create');
        Route::post('/', [StocksController::class, 'store'])->name('stocks.store');
        // Route::get('/{id}', [PaymentMethodsController::class, 'show'])->name('stocks.show');
        // Route::get('/{id}/edit', [PaymentMethodsController::class, 'edit'])->name('stocks.edit');
        Route::put('/', [StocksController::class, 'update'])->name('stocks.update');
        // Route::delete('/{id}', [PaymentMethodsController::class, 'destroy'])->name('stocks.destroy');
    });
});