<?php

namespace App\Actions\ProductAction;

use App\Models\Product;

use function PHPUnit\Framework\isEmpty;

class SearchProductAction
{
    public function execute(string $name = null, int $category_id = null)
    {
        $query = Product::query();
        
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
