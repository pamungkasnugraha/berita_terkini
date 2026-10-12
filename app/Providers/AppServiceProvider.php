<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {

        View::composer('components.navbar', function ($view) {
            $view->with('categories', Category::all());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip())->response(function () use ($request) {
                \Log::warning('Percobaan Brute Force terdeteksi dari IP: ' . $request->ip());
                return response('Terlalu banyak percobaan, coba lagi nanti.', 429);
            });
        });
    }
}