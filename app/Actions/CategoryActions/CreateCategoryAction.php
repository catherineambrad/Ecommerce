<?php

namespace App\Actions\CategoryActions;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;

class CreateCategoryAction
{
    public function execute(array $data)
    {
        try {
            $user = Auth::user();

            $fine_duplicates = Category::where('name', 'like',  $data['name'])->get();

            if (count($fine_duplicates) > 0) {
                return response()->json([
                    'message' => 'Category already exists!'
                ], 400);
            }
            Category::create([
                'name' => $data['name'],
                'user_id' => $user->id
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
