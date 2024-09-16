<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    use HasFactory;

    // Specify the table name (optional if the table name matches the model name in plural form)
    protected $table = 'customer_profiles';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_id',
        'street_address',
        'city',
        'postal_code',
        'preferences',
        'phone_number',
        'profile_photo',
        'preferred_payment_methods',
    ];

    // Cast fields like JSON to arrays
    protected $casts = [
        'preferences' => 'array',
        'preferred_payment_methods' => 'array',
    ];

    /**
     * CustomerProfile belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
