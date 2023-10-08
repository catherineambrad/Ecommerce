<?php

namespace App\Actions\CategoryActions;

use App\Models\Category;
use Exception;

class DeleteCategoryAction
{
    public function execute(int $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category not found!'
                ], 404);
            }

            $category->delete();

            return response()->json([
                'message' => 'Category successfully deleted!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }
}
