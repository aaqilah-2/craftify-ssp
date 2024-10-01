<?php

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RoleAuthentication;
use App\Http\Controllers\Api\ArtisanProfileController;

// Artisan Profile Routes
Route::middleware(['auth:sanctum', RoleAuthentication::class . ':2'])->group(function () {
    
    //profile creation and update routes
    Route::post('/artisan/profile', [ArtisanProfileController::class, 'store']);
    Route::put('/artisan/profile', [ArtisanProfileController::class, 'update']);

    //product creation route
    Route::post('/products', [ProductController::class, 'store']); 
    Route::put('/products/{id}', [ProductController::class, 'update']);

    Route::get('/artisan/products', [ProductController::class, 'getProductsByStatus']);

});
