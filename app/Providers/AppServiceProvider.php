<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::share('galleries', 
            \App\Models\Gallery::where('active', 1)->orderBy('ord', 'asc')->get());

        View::share('settings', 
            \App\Models\Setting::firstOrFail());

        View::share('socialLinks',
            \App\Models\SocialLink::all());
    }
}
