<?php

namespace App\Actions\ProductActions;

use App\Models\Product;

class ReadProductAction
{
    public function execute(array $data)
    {
        $products = Product::with(['category'])->latest()->paginate(5);

        return response()->json([
            'products' => $products->items(),
            'current_page' => $products->currentPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total(),
            'last_page' => $products->lastPage(),
        ]);
    }
}
