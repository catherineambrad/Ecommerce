<?php

namespace App\Http\Controllers;

use App\Actions\CategoryActions\CreateCategoryAction;
use App\Actions\CategoryActions\DeleteCategoryAction;
use App\Actions\CategoryActions\ReadAllCategoriesAction;
use App\Actions\CategoryActions\UpdateCategoryAction;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

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
