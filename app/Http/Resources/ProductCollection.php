<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        // Use the ProductResource to transform each product in the collection
        return [
            'data' => ProductResource::collection($this->collection),  // Transform each product
            'meta' => [
                'total_products' => $this->collection->count(),  // Include meta info
            ]
        ];
    }
}
