<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisanProfile extends Model
{
    use HasFactory;

    // Specify the table name (optional if the table name matches the model name in plural form)
    protected $table = 'artisan_profiles';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_id',
        'street_address',
        'city',
        'postal_code',
        'years_of_experience',
        'skills',
        'bio',
        'social_media_links',
        'logo',
        'contact_number',
        'service_radius_km',
    ];

    // Cast fields like JSON to arrays
    protected $casts = [
        'social_media_links' => 'array',
    ];

    /**
     * ArtisanProfile belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
