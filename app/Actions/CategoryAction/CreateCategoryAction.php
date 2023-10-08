<?php

namespace App\Actions\CategoryAction;

use App\Models\Category;
use Exception;

class CreateCategoryAction
{
    public function execute(array $data)
    {
        try {
            $fine_duplicates = Category::where('name', 'like',  $data['name'])->get();

            if (count($fine_duplicates) > 0) {
                return response()->json([
                    'message' => 'Category already exists!'
                ], 400);
            }
            Category::create([
                'name' => $data['name']
            ]);

            return response()->json([
                'message' => 'Category successfully created!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }
}
