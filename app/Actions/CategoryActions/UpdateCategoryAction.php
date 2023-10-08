<?php

namespace App\Actions\CategoryActions;

use App\Models\Category;
use Exception;

class UpdateCategoryAction
{
    public function execute(array $data, int $id)
    {
        try {
            $category = Category::findOrFail($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category not found!'
                ], 404);
            } else {
                $category->update($data);

                return response()->json([
                    'message' => 'Category successfully updated!'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }
}
