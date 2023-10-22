<?php

namespace App\Actions\ProductActions;

use App\Actions\GlobalActions\UploadImage;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateProductAction
{
    public function execute(array $data, int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found!'
                ], 404);
            }

            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->description = $data['description'];
            $product->category_id = $data['category_id'];
            $product->image = UploadImage::upload($data);

            //Update Product
            $product->save();

            return response()->json([
                'message' => 'Product successfully updated!'
            ], 200);

        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }
}
