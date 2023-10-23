<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

use App\Actions\ProductActions\CreateProductAction;
use App\Actions\ProductActions\ReadProductAction;
use App\Actions\ProductActions\UpdateProductAction;
use App\Actions\ProductActions\DeleteProductAction;
use App\Actions\ProductActions\SearchProductAction;
use App\Actions\ProductActions\ShowOneProductAction;
use App\Actions\ProductActions\UserProductsAction;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'role:admin'])->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReadProductAction $readProductAction, Request $request)
    {
        return $readProductAction->execute(['page' => $request->input('page', 1)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductAction $createProductAction, ProductRequest $request)
    {
        return $createProductAction->execute($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowOneProductAction  $showOneProductAction, $id)
    {
        return $showOneProductAction->execute($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductAction $updateProductAction, ProductRequest $request, $id)
    {
        return $updateProductAction->execute($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteProductAction $deleteProductAction, $id)
    {
        return $deleteProductAction->execute($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search(SearchProductAction $searchProductAction, Request $request)
    {
        return $searchProductAction->execute($request->name, $request->category_id);
    }

    public function getUserProducts(UserProductsAction $userProductsAction, Request $request)
    {
        // return response()->json(['products' => $userProductsAction->execute($request)]);
        return $userProductsAction->execute(['page' => $request->input('page', 1)]);
    }
}
