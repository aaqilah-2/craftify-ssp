<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'artisan_id',
        'name',
        'description',
        'price',
        'category',
        'image',
        'status',
    ];

    // Relationship with Artisan (User model)
    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }

    // Define if status is approved
    public function isApproved()
    {
        return $this->status === 'approved';
    }
}
