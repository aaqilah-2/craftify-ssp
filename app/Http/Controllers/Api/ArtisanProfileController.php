<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Models\ArtisanProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'service_radius_km' => 'nullable|numeric',

        ]);

        // Ensure only artisans are allowed to create a profile
        if (Auth::user()->role !== UserRole::Artisan->value) {
            return response()->json(['message' => 'Unauthorized. Only artisans can create this profile.'], 403);
        }

        $profile = new ArtisanProfile();

    // Handle the logo upload (it is required, so no fallback to null)
    if ($request->has('logo')) {
        $logoPath = $request->file('logo')->store('public/artisan_logos'); // Store the file
        $profile->logo = $logoPath; // Save the logo path (mandatory field)
    } else {
        // Since logo is mandatory, return an error if it's not uploaded
        return response()->json(['message' => 'Logo is required'], 400);
    }
        // if ($request->has('logo')) {
        //     $logoData = $request->input('logo');

        //     // Check if the logo is base64-encoded
        //     if (strpos($logoData, 'data:image/') === 0) {
        //         // Decode the base64 string and store it as a file
        //         preg_match('/^data:image\/(\w+);base64,/', $logoData, $type);
        //         $logoData = substr($logoData, strpos($logoData, ',') + 1);
        //         $logoData = base64_decode($logoData);

        //         $fileName = 'artisan_logo_' . time() . '.' . $type[1]; // Create a file name with extension
        //         Storage::put('public/artisan_logos/' . $fileName, $logoData);
        //         $profile->logo = 'public/artisan_logos/' . $fileName;
        //     } else {
        //         // Handle regular file upload case (e.g., non-web environments)
        //         $logoPath = $request->file('logo')->store('public/artisan_logos');
        //         $profile->logo = $logoPath;
        //     }
        // }

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
            'logo' => $profile->logo,
            'service_radius_km' => $request->service_radius_km ?? null,
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
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',// No specific validation, handling base64 or file
        ]);

        // Handle logo update if present
    if ($request->hasFile('logo')) {
        // Delete old logo if it exists
        if ($profile->logo) {
            Storage::delete($profile->logo); // Delete the old logo
        }
        // Store new uploaded logo
        $profile->logo = $request->file('logo')->store('public/artisan_logos'); // Save new logo
    }

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
