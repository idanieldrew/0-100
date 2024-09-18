<?php

namespace App\Http\Controllers\Carts\v1;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartItemController extends BaseCartController
{
    public function destroy(CartItem $item)
    {
        //
    }
}
