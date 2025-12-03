<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('*', function ($view) {
            if (\Illuminate\Support\Facades\Auth::check()) {
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
                $view->with('wishlistCount', $wishlistCount);
            } else {
                $view->with('wishlistCount', 0);
            }
            $settings = Setting::first();
            $view->with('settings', $settings);
        });
    }
}
