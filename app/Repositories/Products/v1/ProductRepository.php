<?php

namespace App\Repositories\Products\v1;

use App\Models\Product;

class ProductRepository
{
    public function store($data)
    {
        Product::query()
            ->create([
                'slug' => $data->slug,
                'price' => $data->price
            ]);

        return true;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public static function show($id): mixed
    {
        return Product::query()
            ->where('id', $id)
            ->firstOrFail();
    }
}
