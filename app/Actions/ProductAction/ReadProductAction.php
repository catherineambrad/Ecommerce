<?php

namespace App\Actions\ProductAction;

use App\Models\Product;

class ReadProductAction
{
    public function execute(array $data)
    {
        $products = Product::latest()->paginate(5);

        return response()->json([
            'data' => $products->items(),
            'current_page' => $data,
            'per_page' => 5,
            'total' => $products->total(),
            'last_page' => $products->lastPage(),
        ]);
    }
}
