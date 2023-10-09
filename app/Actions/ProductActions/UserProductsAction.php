<?php

namespace App\Actions\ProductActions;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserProductsAction
{
    public function execute(array $data)
    {
        $user = Auth::user();


        $products = Product::where('user_id', $user->id)
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
