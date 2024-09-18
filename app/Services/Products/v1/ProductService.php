<?php

namespace App\Services\Products\v1;

use App\Events\ProductGenerated;
use App\Repositories\Products\v1\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * @throws \Exception
     */
    public function store($request)
    {
        DB::beginTransaction();

        try {
            // resolve repository & store data
            $repository = resolve(ProductRepository::class);
            $response_repo = $repository->store($request);

            ProductGenerated::dispatch(
                $request->slug,
                $request->price
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $response_repo;
    }
}
