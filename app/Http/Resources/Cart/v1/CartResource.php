<?php

namespace App\Http\Resources\Cart\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'total' => $this->total,
            'items' => new CartItemCollection($this->cart_items)
        ];
    }
}
