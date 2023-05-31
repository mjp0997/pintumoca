<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\ProductsController;
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
    // POST
    Route::get('/{id}', [OfficesController::class, 'show'])->name('offices.show');
    Route::get('/{id}/edit', [OfficesController::class, 'edit'])->name('offices.edit');
    // PUT
    // DELETE
});

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    // POST
    Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
    Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    // PUT
    // DELETE
});

Route::prefix('/payment-methods')->group(function () {
    Route::get('/', [PaymentMethodsController::class, 'index'])->name('payment-methods.index');
    Route::get('/create', [PaymentMethodsController::class, 'create'])->name('payment-methods.create');
    // POST
    Route::get('/{id}', [PaymentMethodsController::class, 'show'])->name('payment-methods.show');
    Route::get('/{id}/edit', [PaymentMethodsController::class, 'edit'])->name('payment-methods.edit');
    // PUT
    // DELETE
});