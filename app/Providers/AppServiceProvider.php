<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use Illuminate\Support\ServiceProvider;

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
        $websiteSettings = WebsiteSetting::first();

        view()->share('websiteSettings', $websiteSettings);
    }
}