<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->category_name
            ],
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'path' => asset('storage/' . $image->path),
                    'is_primary' => $image->is_primary
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
