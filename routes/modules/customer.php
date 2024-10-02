<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RoleAuthentication;
use App\Http\Controllers\Api\CustomerProfileController;

// Customer Profile Routes
Route::middleware(['auth:sanctum', RoleAuthentication::class . ':3'])->group(function () {
    Route::post('/customer/profile', [CustomerProfileController::class, 'store']);
    Route::put('/customer/profile', [CustomerProfileController::class, 'update']);
    
    
    Route::get('/products', [ProductController::class, 'getApprovedProducts']);




    });
