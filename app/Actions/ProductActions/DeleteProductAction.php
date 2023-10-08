<?php

namespace App\Actions\ProductActions;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DeleteProductAction
{
    public function execute(int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found!'
                ], 404);
            }

            $storage = Storage::disk('public');
            // delete old image
            if ($storage->exists($product->image)) {
                $storage->delete($product->image);
            }

            // Delete Product
            $product->delete();

            return response()->json([
                'message' => 'Product successfully deleted!'
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }
}
