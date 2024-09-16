<?php

use App\Http\Controllers\Api\ArtisanProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Http\Middleware\RoleAuthentication;

// Artisan Profile Routes
Route::middleware(['auth:sanctum', RoleAuthentication::class . ':2'])->group(function () {
    Route::post('/artisan/profile', [ArtisanProfileController::class, 'store']);
    Route::put('/artisan/profile', [ArtisanProfileController::class, 'update']);
});
