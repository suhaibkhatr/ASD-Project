<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Storehouse;
use App\Models\User;
use Illuminate\Support\Facades\Route;
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
        Route::model("user", User::class);
        Route::model("storehouse", Storehouse::class);
        Route::model("category", Category::class);
    }
}
