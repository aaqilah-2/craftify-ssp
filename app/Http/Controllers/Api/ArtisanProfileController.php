<?php

namespace App\Http\Controllers\Api;

use App\Models\ArtisanProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Enums\UserRole;

class ArtisanProfileController extends Controller
{
    public function store(Request $request)
    {
        // Validate the profile creation data
        $request->validate([
            'street_address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'years_of_experience' => 'required|integer',
            'skills' => 'required|string',
            'bio' => 'required|string',
            'contact_number' => 'required|string',
            'logo' => 'required|string',
        ]);

        // Ensure only artisans are allowed to create a profile
        if (Auth::user()->role !== UserRole::Artisan->value) {
            return response()->json(['message' => 'Unauthorized. Only artisans can create this profile.'], 403);
        }

        // Create the artisan profile
        $profile = ArtisanProfile::create([
            'user_id' => Auth::id(),
            'street_address' => $request->street_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'years_of_experience' => $request->years_of_experience,
            'skills' => $request->skills,
            'bio' => $request->bio,
            'contact_number' => $request->contact_number,
            'logo' => $request->logo,
        ]);

        return response()->json($profile, 201);
    }

    public function update(Request $request)
    {
        // Find the profile for the authenticated user
        $profile = ArtisanProfile::where('user_id', Auth::id())->firstOrFail();

        // Validate update data
        $request->validate([
            'street_address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'postal_code' => 'sometimes|string',
            'years_of_experience' => 'sometimes|integer',
            'skills' => 'sometimes|string',
            'bio' => 'sometimes|string',
            'contact_number' => 'sometimes|string',
        ]);

        // Update the profile
        $profile->update($request->only([
            'street_address',
            'city',
            'postal_code',
            'years_of_experience',
            'skills',
            'bio',
            'contact_number',
        ]));

        return response()->json($profile, 200);
    }
}
