<?php

namespace App\Repositories\Carts\v1;

use App\Models\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartRepository
{
    public static function get_cart_items_by_cart(Cart $cart): Collection
    {
        return $cart->cart_items;
    }

    public static function store(mixed $total)
    {
        return Cart::query()
            ->create([
                'user_id' => Auth::id(),
                'total' => $total
            ]);
    }

    public static function update(Cart $cart, $price)
    {
        return $cart->increment('total', $price);
    }

    public static function delete()
    {
        return Cart::query()
            ->whereTime('created_at', '<', now()->subHours(12))
            ->delete();
    }
}
