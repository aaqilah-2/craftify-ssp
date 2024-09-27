<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerProfileController extends Controller
{
    public function store(Request $request)
    {
        // Ensure only customers are allowed to create a profile
        if (Auth::user()->role !== UserRole::Customer->value) {
            return response()->json([
                'message' => 'Unauthorized. Only customers can create this profile.'
            ], 403);
        }

        // Validate the profile creation data
        $request->validate([
            'street_address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'preferences' => 'required|array',
            'phone_number' => 'required|string',
            'profile_photo' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create the customer profile
        $profile = CustomerProfile::create([
            'user_id' => Auth::id(),
            'street_address' => $request->street_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'preferences' => $request->preferences,
            'phone_number' => $request->phone_number,
            'profile_photo' => $request->file('profile_photo') ? $request->file('profile_photo')->store('public/customer_profiles') : null, 
            'preferred_payment_methods' => $request->preferred_payment_methods,
        ]);

        return response()->json($profile, 201);
    }

    public function update(Request $request)
    {
        // Ensure only customers are allowed to update their profile
        if (Auth::user()->role !== UserRole::Customer->value) {
            return response()->json([
                'message' => 'Unauthorized. Only customers can update this profile.'
            ], 403);
        }

        // Find the profile for the authenticated user
        $profile = CustomerProfile::where('user_id', Auth::id())->firstOrFail();

        // Validate update data
        $request->validate([
            'street_address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'postal_code' => 'sometimes|string',
            'preferences' => 'sometimes|array',
            'phone_number' => 'sometimes|string',
            'profile_photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

         // Handle profile photo update
    if ($request->hasFile('profile_photo')) {
        // Store new uploaded profile photo and remove the old one
        if ($profile->profile_photo) {
            Storage::delete($profile->profile_photo); // Delete old photo if it exists
        }
        $profile->profile_photo = $request->file('profile_photo')->store('public/customer_profiles'); // Store new photo
    }

        // Update the profile
        $profile->update($request->only([
            'street_address',
            'city',
            'postal_code',
            'preferences',
            'phone_number',
        ]));

        return response()->json($profile, 200);
    }
}
