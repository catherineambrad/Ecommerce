<?php

namespace App\Actions\CategoryActions;

use App\Models\Category;

class ReadAllCategoriesAction
{
    public function execute()
    {
        return Category::all();
    }
}
