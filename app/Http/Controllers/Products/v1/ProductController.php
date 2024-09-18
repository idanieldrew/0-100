<?php

namespace App\Http\Controllers\Products\v1;

use App\Http\Requests\Products\v1\ProductRequest;
use App\Services\Products\v1\ProductService;
use Illuminate\Http\Response;

class ProductController extends BaseProductController
{
    public function store(ProductRequest $request, ProductService $service)
    {
        $service->store($request);

        return response_api(
            'success',
            Response::HTTP_OK,
            'Successfully create product',
            []
        );
    }
}
