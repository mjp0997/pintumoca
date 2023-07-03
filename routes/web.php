<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\ProceduresController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalePaymentsController;
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

Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::group(['prefix' => '/users', 'middleware' => 'role:admin'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/', [UsersController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });

    Route::group(['prefix' => '/offices', 'middleware' => 'role:admin'], function () {
        Route::get('/', [OfficesController::class, 'index'])->name('offices.index');
        Route::get('/create', [OfficesController::class, 'create'])->name('offices.create');
        Route::post('/', [OfficesController::class, 'store'])->name('offices.store');
        Route::get('/{id}', [OfficesController::class, 'show'])->name('offices.show');
        Route::get('/{id}/edit', [OfficesController::class, 'edit'])->name('offices.edit');
        Route::put('/{id}', [OfficesController::class, 'update'])->name('offices.update');
        Route::delete('/{id}', [OfficesController::class, 'destroy'])->name('offices.destroy');
    });

    Route::group(['prefix' => '/products'], function () {
        Route::get('/', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductsController::class, 'create'])->middleware(['role:admin'])->name('products.create');
        Route::get('/mass-create', [ProductsController::class, 'mass_create'])->middleware(['role:admin'])->name('products.mass-create');
        Route::get('/mass-edit', [ProductsController::class, 'mass_edit'])->middleware(['role:admin'])->name('products.mass-edit');
        Route::post('/', [ProductsController::class, 'store'])->middleware(['role:admin'])->name('products.store');
        Route::post('/mass-read', [ProductsController::class, 'mass_read'])->middleware(['role:admin'])->name('products.mass-read');
        Route::post('/mass-store', [ProductsController::class, 'mass_store'])->middleware(['role:admin'])->name('products.mass-store');
        Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->middleware(['role:admin'])->name('products.edit');
        Route::put('/mass-update', [ProductsController::class, 'mass_update'])->middleware(['role:admin'])->name('products.mass-update');
        Route::put('/{id}', [ProductsController::class, 'update'])->middleware(['role:admin'])->name('products.update');
        Route::delete('/{id}', [ProductsController::class, 'destroy'])->middleware(['role:admin'])->name('products.destroy');
    });

    Route::group(['prefix' => '/payment-methods', 'middleware' => 'role:admin'], function () {
        Route::get('/', [PaymentMethodsController::class, 'index'])->name('payment-methods.index');
        Route::get('/create', [PaymentMethodsController::class, 'create'])->name('payment-methods.create');
        Route::post('/', [PaymentMethodsController::class, 'store'])->name('payment-methods.store');
        Route::get('/{id}', [PaymentMethodsController::class, 'show'])->name('payment-methods.show');
        Route::get('/{id}/edit', [PaymentMethodsController::class, 'edit'])->name('payment-methods.edit');
        Route::put('/{id}', [PaymentMethodsController::class, 'update'])->name('payment-methods.update');
        Route::delete('/{id}', [PaymentMethodsController::class, 'destroy'])->name('payment-methods.destroy');
    });

    Route::group(['prefix' => '/sales'], function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales.index');
        Route::get('/create', [SalesController::class, 'create'])->name('sales.create');
        Route::post('/', [SalesController::class, 'store'])->name('sales.store');
        Route::get('/{id}', [SalesController::class, 'show'])->name('sales.show');
        // Route::get('/{id}/edit', [SalesController::class, 'edit'])->name('sales.edit');
        // Route::put('/{id}', [SalesController::class, 'update'])->name('sales.update');
        Route::delete('/{id}', [SalesController::class, 'destroy'])->middleware(['is_owner:Procedure'])->name('sales.destroy');
    });

    Route::group(['prefix' => '/stocks'], function () {
        // Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
        // Route::get('/create', [StocksController::class, 'create'])->name('stocks.create');
        Route::post('/', [StocksController::class, 'store'])->name('stocks.store');
        // Route::get('/{id}', [StocksController::class, 'show'])->name('stocks.show');
        // Route::get('/{id}/edit', [StocksController::class, 'edit'])->name('stocks.edit');
        Route::put('/', [StocksController::class, 'update'])->name('stocks.update');
        // Route::delete('/{id}', [StocksController::class, 'destroy'])->name('stocks.destroy');
    });

    Route::group(['prefix' => '/procedures'], function () {
        Route::get('/', [ProceduresController::class, 'index'])->name('procedures.index');
        Route::get('/create', [ProceduresController::class, 'create'])->name('procedures.create');
        Route::post('/', [ProceduresController::class, 'store'])->name('procedures.store');
        Route::get('/{id}', [ProceduresController::class, 'show'])->name('procedures.show');
        // Route::get('/{id}/edit', [ProceduresController::class, 'edit'])->name('procedures.edit');
        // Route::put('/', [ProceduresController::class, 'update'])->name('procedures.update');
        Route::delete('/{id}', [ProceduresController::class, 'destroy'])->middleware(['is_owner:Procedure'])->name('procedures.destroy');
    });

    Route::group(['prefix' => '/sale-payments'], function () {
        // Route::get('/', [SalePaymentsController::class, 'index'])->name('sale-payments.index');
        // Route::get('/create', [SalePaymentsController::class, 'create'])->name('sale-payments.create');
        Route::post('/', [SalePaymentsController::class, 'store'])->name('sale-payments.store');
        // Route::get('/{id}', [SalePaymentsController::class, 'show'])->name('sale-payments.show');
        // Route::get('/{id}/edit', [SalePaymentsController::class, 'edit'])->name('sale-payments.edit');
        // Route::put('/', [SalePaymentsController::class, 'update'])->name('sale-payments.update');
        Route::delete('/{id}', [SalePaymentsController::class, 'destroy'])->name('sale-payments.destroy');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});