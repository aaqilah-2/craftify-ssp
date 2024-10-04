<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RoleAuthentication;
use App\Http\Controllers\Api\CustomerProfileController;
use App\Http\Controllers\FavoritesController;


// Customer Profile Routes
    Route::middleware(['auth:sanctum', RoleAuthentication::class . ':3'])->group(function () {
    Route::post('/customer/profile', [CustomerProfileController::class, 'store']);
    Route::put('/customer/profile', [CustomerProfileController::class, 'update']);
    
    
   Route::get('/products', [ProductController::class, 'getApprovedProducts']);
   Route::get('/products/{id}', [ProductController::class, 'show']);


      //favourites 
    Route::post('/favorites', [FavoritesController::class, 'addToFavorites']);
    Route::get('/favorites', [FavoritesController::class, 'getFavorites']);
    Route::delete('/favorites', [FavoritesController::class, 'removeFromFavorites']);






    });
