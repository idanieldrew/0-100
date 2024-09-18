<?php

namespace App\Services\Carts\v1;

use App\Repositories\Carts\v1\CartItemRepository;
use App\Repositories\Carts\v1\CartRepository;
use App\Repositories\Products\v1\ProductRepository;
use App\Services\BaseService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService implements BaseService
{
    public function store($request)
    {
        DB::beginTransaction();

        try {
            $response = [];
            $product = ProductRepository::show($request->product_id);
            if ($product->stock == 0) {
                throw new \Exception(
                    'This product is out of stock',
                    Response::HTTP_FORBIDDEN);
            }
            $cart = Auth::user()->cart;
            $total = $product->price * $request->quantity;

            if ($cart) {
                CartRepository::update($cart, $total);
                $cartItems = CartRepository::get_cart_items_by_cart($cart);

                if ($cartItems->where('product_id', $product->id)->isNotEmpty()) {
                    throw new \Exception(
                        'This product was in your shopping cart.',
                        Response::HTTP_FORBIDDEN);
                }

                CartItemRepository::create_items_by_product(
                    $product,
                    $cart->id,
                    $request->quantity
                );

                $response = [
                    'success',
                    Response::HTTP_CREATED,
                    'This product has been added to your shopping cart.',
                    $product
                ];
            }

            if ($cart == null) {
                $cart = CartRepository::store($total);
                CartItemRepository::create_items_by_product(
                    $product,
                    $cart->id,
                    $request->quantity
                );
                $response = [
                    'success',
                    Response::HTTP_CREATED,
                    'This product has been added to your shopping cart0.',
                    $product
                ];
            }

            DB::commit();

            return response_api(
                $response[0],
                $response[1],
                $response[2],
                $response[3],
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('update_invoice_date', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTrace()
            ]);
            return response_api(
                'error',
                $exception->getCode(),
                $exception->getMessage(),
                []
            );
        }
    }

    public function response($status, $code, $msg, $data = null)
    {
        return [
            'status' => $status,
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ];
    }
}
