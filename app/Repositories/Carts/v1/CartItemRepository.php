<?php

namespace App\Repositories\Carts\v1;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class CartItemRepository
{
    public static function create_items_by_product(Product $product, int $cart_id, int $quantity)
    {
        return $product->cart_items()
            ->create([
                'cart_id' => $cart_id,
                'quantity' => $quantity,
                'price' => $price = $product->price,
                'total' => $price * $quantity
            ]);
    }
}
