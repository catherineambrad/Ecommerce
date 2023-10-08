<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

use App\Actions\ProductAction\CreateProductAction;
use App\Actions\ProductAction\ReadProductAction;
use App\Actions\ProductAction\UpdateProductAction;
use App\Actions\ProductAction\DeleteProductAction;
use App\Actions\ProductAction\SearchProductAction;
use App\Actions\ProductAction\ShowOneProductAction;

class ProductController extends Controller
{
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
}
