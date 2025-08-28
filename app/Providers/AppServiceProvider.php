<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductVariant;
use App\Observers\StockCriticalProductObserver;


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
        ProductVariant::observe(StockCriticalProductObserver::class);
    }
}
