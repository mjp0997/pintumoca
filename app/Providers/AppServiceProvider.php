<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

// Pagination
use Illuminate\Pagination\Paginator;

// Components
use App\View\Components\dashboard\InfoBox;
use App\View\Components\dashboard\SalesList;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Dashboard components
        Blade::component('info-box', InfoBox::class);
        Blade::component('sales-list', SalesList::class);
        
        Paginator::useBootstrapFour();
    }
}
