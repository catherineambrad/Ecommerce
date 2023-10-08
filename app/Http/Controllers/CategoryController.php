<?php

namespace App\Http\Controllers;

use App\Actions\CategoryAction\CreateCategoryAction;
use App\Actions\CategoryAction\DeleteCategoryAction;
use App\Actions\CategoryAction\ReadAllCategoriesAction;
use App\Actions\CategoryAction\UpdateCategoryAction;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(ReadAllCategoriesAction $readAllCategoriesAction)
    {
        return $readAllCategoriesAction->execute();
    }

    public function store(CreateCategoryAction $createCategoryAction, CategoryRequest $request)
    {
        return $createCategoryAction->execute($request->validated());
    }

    public function edit(UpdateCategoryAction $updateCategoryAction, CategoryRequest $request, $id)
    {
        return $updateCategoryAction->execute($request->validated(), $id);
    }

    public function destroy(DeleteCategoryAction $deleteCategoryAction, $id)
    {
        return $deleteCategoryAction->execute($id);
    }
}
