<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Count products by status
        $pendingCount = Product::where('status', 'pending')->count();
        $approvedCount = Product::where('status', 'approved')->count();
        $rejectedCount = Product::where('status', 'rejected')->count();

        // Count customers and artisans by role using enum integer values
        $customerCount = User::where('role', UserRole::Customer->value)->count();
        $artisanCount = User::where('role', UserRole::Artisan->value)->count();

        // Pass these counts to the dashboard view
        return view('dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount', 'customerCount', 'artisanCount'));
    }
    

}
