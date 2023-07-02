<?php

namespace App\Providers;

use App\View\Components\dashboard\InfoBox;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

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
        
        Paginator::useBootstrapFour();
    }
}
