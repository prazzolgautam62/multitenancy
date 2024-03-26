<?php

namespace App\Providers;

use App\Models\Main\Tenant;
use App\Observers\TenantObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Tenant::observe(TenantObserver::class);
    }
}
