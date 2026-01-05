<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.ll
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float)$this->price,
            'quantity' => $this->quantity,
            'status' => (bool)$this->status,
            'image' => $this->image,
            'category' => [
                'uuid' => $this->category_id,
                'name' => $this->category->name,
            ],
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
