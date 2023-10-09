<?php

namespace App\Actions\ProductActions;

use App\Models\Product;

class SearchProductAction
{
    public function execute(string $name = null, int $category_id = null)
    {
        $query = Product::with(['category']);
        
        if ($name != null) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($category_id != null) {
            $query->where('category_id', $category_id);
        }

        $products = $query->get();

        return response()->json([
            'products' => $products
        ], 200);
    }
}
