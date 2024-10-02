<?php
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleAuthentication;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductApprovalController;

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



Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::post('/admin/users/{id}/update', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.delete');

Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users/create', [AdminUserController::class, 'store'])->name('admin.users.store');


// Route to list only customers
Route::get('/admin/users/customers', [AdminUserController::class, 'showCustomers'])->name('admin.users.customers');
    
// Route to list only artisans
Route::get('/admin/users/artisans', [AdminUserController::class, 'showArtisans'])->name('admin.users.artisans');

});
