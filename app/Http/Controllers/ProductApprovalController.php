<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductApprovalController extends Controller
{
    // Admin can approve products
    public function approveProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'approved';  // Set status to approved
        $product->save();

       // return response()->json(['message' => 'Product approved'], 200);
       return redirect('/admin/products')->with('success', 'Product approved successfully');
    }

    // Admin can reject products
    public function rejectProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 'rejected';  // Set status to rejected
        $product->save();

       // return response()->json(['message' => 'Product rejected'], 200);
    
       return redirect('/admin/products')->with('error', 'Product rejected');
    }



    // Fetch all pending products (for admin review)
        public function showPendingProducts()
    {
        // Fetch all pending products
        $products = Product::where('status', 'pending')->get();
        
        // Return the Blade view with products data
        return view('admin.pending-products', compact('products'));
    }

    // Show all approved products for admin
    public function showApprovedProducts()
    {
        $products = Product::where('status', 'approved')->get();
        return view('admin.approved-products', compact('products'));
    }

    // Show all rejected products for admin
    public function showRejectedProducts()
    {
        $products = Product::where('status', 'rejected')->get();
        return view('admin.rejected-products', compact('products'));
    }



    
}
