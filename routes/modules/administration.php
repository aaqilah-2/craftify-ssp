<?php
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductApprovalController;
use App\Http\Middleware\RoleAuthentication;

Route::middleware(['auth:sanctum', RoleAuthentication::class . ':1'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');



 // Admin-only routes for approving and rejecting products
 Route::post('/products/{id}/approve', [ProductApprovalController::class, 'approveProduct']);
 Route::post('/products/{id}/reject', [ProductApprovalController::class, 'rejectProduct']);
 Route::get('/admin/products', [ProductApprovalController::class, 'showPendingProducts']); 
 Route::get('/admin/products/approved', [ProductApprovalController::class, 'showApprovedProducts']);
 Route::get('/admin/products/rejected', [ProductApprovalController::class, 'showRejectedProducts']);  

});
