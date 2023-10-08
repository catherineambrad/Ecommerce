<?php

namespace App\Actions\ProductAction;

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

            if ($data['image']) {
                $storage = Storage::disk('public');
                // delete old image
                if ($storage->exists($product->image)) {
                    $storage->delete($product->image);
                }

                // Image name
                $imageName = Str::random(32) . "." . $data['image']->getClientOriginalExtension();
                $product->image = $imageName;

                // Image save in public folder
                $storage->put($imageName, file_get_contents($data['image']));
            }

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
