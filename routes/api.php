<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Enums\UserRole;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// For user authentication (login or register)
Route::post('/user/auth', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');



require_once __DIR__.'/modules/artisan.php';
require_once __DIR__.'/modules/customer.php';







Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});





