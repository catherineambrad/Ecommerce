<?php

namespace App\Actions\CategoryAction;

use App\Models\Category;

class ReadAllCategoriesAction
{
    public function execute()
    {
        return Category::all();
    }
}
