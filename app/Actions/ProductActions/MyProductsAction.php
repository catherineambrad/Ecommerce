<?php

namespace App\Actions\ProductActions;

use App\Models\Product;

class MyProductsAction
{
    public function execute(array $data)
    {
        $products = Product::where('user_id', auth()->user()->id)
            ->with(['category'])
            ->latest()
            ->paginate(5);

        return response()->json([
            'products' => $products->items(),
            'current_page' => $products->currentPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total(),
            'last_page' => $products->lastPage(),
        ]);
    }
}
