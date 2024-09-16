<?php

namespace App\Providers;

use App\Enums\UserRole;
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
        // Bind the role for customer
        Route::bind('customer', function (string $value) {
            return User::where('role', UserRole::Customer->value)  // Use enum's value
                ->where('id', $value)
                ->firstOrFail();
        });

        // Bind the role for administrator
        Route::bind('admin', function (string $value) {
            return User::where('role', UserRole::Administrator->value)  // Use enum's value
                ->where('id', $value)
                ->firstOrFail();
        });

        // Bind the role for artisan
        Route::bind('artisan', function (string $value) {
            return User::where('role', UserRole::Artisan->value)  // Use enum's value
                ->where('id', $value)
                ->firstOrFail();
        });
    }
}
