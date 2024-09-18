<?php

namespace App\Http\Controllers\Carts\v1;

use App\Http\Requests\Carts\v1\CartRequest;
use App\Http\Resources\Cart\v1\CartResource;
use App\Models\User;
use App\Services\Carts\v1\CartService;
use Illuminate\Http\Response;

class CartController
{
    /**
     * Show user cart
     *
     * @param User $user
     * @return array
     */
    public function index(User $user)
    {
        return response_api(
            'success',
            Response::HTTP_OK,
            'User shopping cart',
            new CartResource($user->cart)
        );
    }

    /**
     * @param CartRequest $request
     * @param CartService $service
     * @return array
     * @throws \Exception
     */
    public function store(CartRequest $request, CartService $service)
    {
        $result = $service->store($request);

        return response_api(
            $result['status'],
            $result['code'],
            $result['message'],
            $result['data']
        );
    }
}
