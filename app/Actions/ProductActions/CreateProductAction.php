<?php

namespace App\Actions\ProductActions;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateProductAction
{
    public function execute(array $data)
    {
        try {
            $imageName = Str::random(32) . "." . $data['image']->getClientOriginalExtension();

            $user = Auth::user();

            // Create Product
            Product::create([
                'name' => $data['name'],
                'image' => $imageName,
                'price' => $data['price'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'user_id' => $user->id
            ]);

            // Save Image in Storage folder
            Storage::disk('public')->put($imageName, file_get_contents($data['image']));

            // Return Json Response
            return response()->json([
                'message' => "Product successfully created."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }
}
