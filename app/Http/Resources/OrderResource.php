<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "user_id" => $this->user_id,
            "status" => $this->status,
            "total_amount" => $this->total_amount,
            "payment_method" => $this->payment_method,
            "address" => $this->address,
            "description" => $this->description,
            "products" => ProductResource::collection($this->products),
        ];
    }
}
