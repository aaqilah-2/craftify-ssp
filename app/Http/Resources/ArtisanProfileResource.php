<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtisanProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'years_of_experience' => $this->years_of_experience,
            'skills' => $this->skills,
            'bio' => $this->bio,
            'social_media_links' => $this->social_media_links,
            'logo' => $this->logo,
            'contact_number' => $this->contact_number,
            'service_radius_km' => $this->service_radius_km,
        ];
    }
}
