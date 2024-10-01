<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    { $data = [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'price' => $this->price,
        'category' => $this->category,
        'image_url' => url('storage/' . $this->image),
    ];

    // Check if the user is an admin or artisan to include additional fields
    if (Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2)) {
        $data['artisan_id'] = $this->artisan_id;
        $data['status'] = $this->status;
    }

    return $data;
    }
}
