<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

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
       view()->composer('*', function ($view) {
            if (Auth::check()) {
                $setting = Setting::where('user_id', Auth::id())->first();
                $view->with('userSetting', $setting);
            }
        });
    }
}