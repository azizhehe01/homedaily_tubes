<?php 

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JasaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product_id, // Mengakses kolom product_id
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => [
                'id' => $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
