<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class FavoritesController extends Controller
{
    /**
     * Add a product to the favorites list.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToFavorites(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Check if the user is a customer
        if ($user->role !== UserRole::Customer->value) {
            return response()->json(['error' => 'You must be a customer to add favorites.'], 403);
        }

        // Add the favorite
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);

        return response()->json(['success' => 'Product added to favorites!', 'favorite' => $favorite]);
    }

    /**
     * Get all favorites for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFavorites()
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Fetch favorites for the user
        $favorites = Favorite::where('user_id', $user->id)->with('product')->get();

        return response()->json(['favorites' => $favorites]);
    }

    /**
     * Remove a product from the favorites list.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromFavorites(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Delete the favorite
        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => 'Product removed from favorites!']);
        }

        return response()->json(['error' => 'Favorite not found.'], 404);
    }
}
