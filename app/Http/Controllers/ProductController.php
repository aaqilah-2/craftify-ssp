<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;  // Import ProductResource
use App\Http\Resources\ProductCollection;  // Import ProductCollection

class ProductController extends Controller
{

                public function store(Request $request)
            {

              
                // Log the request data
                Log::info('Store Product Request Data: ', $request->all());

                // Validation rules for the product fields
                $request->validate([
                    'name' => 'required|string',
                    'description' => 'required|string',
                    'price' => 'required|numeric',
                    'category' => 'required|string',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                // Log validation passed
                Log::info('Validation Passed');

                $imagePath = $request->file('image')->store('products', 'public');
                Log::info('Image Path: ' . $imagePath);

                // Create a new product in the database
                $product = Product::create([
                    'artisan_id' => Auth::id(),
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'category' => $request->category,
                    'image' => $imagePath,
                    'status' => 'pending',
                ]);

                // Log product creation
                Log::info('Product Created: ', $product->toArray());

                // Return the newly created product using ProductResource
                return new ProductResource($product);
            }

                // Artisan can update their own products
                public function update(Request $request, $id)
                {
                    // Find the product to be updated
                    $product = Product::where('id', $id)->where('artisan_id', Auth::id())->firstOrFail();

                    // Validation for product update
                    $request->validate([
                        'name' => 'sometimes|string',
                        'description' => 'sometimes|string',
                        'price' => 'sometimes|numeric',
                        'category' => 'sometimes|string',
                        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                    // Update the product fields if provided
                    if ($request->has('name')) {
                        $product->name = $request->name;
                    }

                    if ($request->has('description')) {
                        $product->description = $request->description;
                    }

                    if ($request->has('price')) {
                        $product->price = $request->price;
                    }

                    if ($request->has('category')) {
                        $product->category = $request->category;
                    }

                    // If there's a new image, replace the old one
                    if ($request->hasFile('image')) {
                        $imagePath = $request->file('image')->store('products', 'public');

                        $product->image = $imagePath;
                    }

                    // Save the updated product
                    $product->save();

                    // Return the updated product using ProductResource
                    return new ProductResource($product);
                }


    // Artisan can delete their own products
                public function destroy($id)
                {
                    // Find the product to be deleted
                    $product = Product::where('id', $id)->where('artisan_id', Auth::id())->firstOrFail();

                    // Delete the product
                    $product->delete();

                    // Return a response indicating successful deletion
                    return response()->json(['message' => 'Product deleted successfully'], 200);
                }



            // Fetch a single product (for product details)
            public function show($id)
            {
                // Fetch the product by ID
                $product = Product::findOrFail($id);

                // Return the product as a resource
                return new ProductResource($product);
            }

            // Fetch all approved products (for customer browsing)
            public function index()
            {
                // Only fetch products that have been approved by the admin
                $approvedProducts = Product::where('status', 'approved')->get();

                // Return the approved products as a collection using ProductCollection
                return new ProductCollection($approvedProducts);

                
            }

        // Get artisan's products by status
            // public function getProductsByStatus(Request $request)
            // {
            //     // Validate the 'status' query parameter
            //     $request->validate([
            //         'status' => 'required|in:pending,approved,rejected',
            //     ]);

            //     // Fetch products based on the status for admin (no artisan filter)
            //     if (Auth::user()->role == 'admin') {
            //         $products = Product::where('status', $request->status)->get();
            //     } else {
            //         // For artisans, only fetch their own products
            //         $products = Product::where('artisan_id', Auth::id())
            //                             ->where('status', $request->status)
            //                             ->get();
            //     }

            //     // Return the products as a collection
            //     return new ProductCollection($products);
            // }
            public function getProductsByStatus(Request $request)
            {
                // Validate the 'status' query parameter
                $request->validate([
                    'status' => 'required|in:pending,approved,rejected',
                ]);
            
                // Fetch products only for the artisan based on their status
                $products = Product::where('artisan_id', Auth::id())
                                    ->where('status', $request->status)
                                    ->get();
            
                // Return the products as a collection
                return new ProductCollection($products);
            }
            
            




            // Method to get approved products for customer view
            public function getApprovedProducts(Request $request)
            {
                $status = $request->query('status', 'approved'); // Defaults to 'approved'
                
                // Assuming 'status' field exists on Product model
                $approvedProducts = Product::where('status', $status)->get();
        
                return response()->json([
                    'data' => $approvedProducts,
                ], 200);
            }

        



   



    
}
