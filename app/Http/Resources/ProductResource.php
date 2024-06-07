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
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_name" => $this->product_name,
            "pivot" => [
                "order_id" => $this->pivot->order_id,
                "product_id" => $this->pivot->product_id,
                "quantity" => $this->pivot->quantity,
                "warranties" => json_decode($this->pivot->warranties),
            ]
        ];

    }
}
