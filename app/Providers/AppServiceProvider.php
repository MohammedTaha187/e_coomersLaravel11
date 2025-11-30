<?php

namespace App\Providers;

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
                $wishlistCount = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
                $view->with('wishlistCount', $wishlistCount);
            } else {
                $view->with('wishlistCount', 0);
            }
        });
    }
}
