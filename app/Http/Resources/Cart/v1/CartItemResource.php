<?php

namespace App\Http\Resources\Cart\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'total' => $this->total
        ];
    }
}
