<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(5);
        $currentPage = $request->input('page', 1);

        return response()->json([
            'data' => $products->items(),
            'current_page' => $currentPage,
            'per_page' => 5,
            'total' => $products->total(),
            'last_page' => $products->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();

            // Create Product
            Product::create([
                'name' => $request->name,
                'image' => $imageName,
                'price' => $request->price,
                'description' => $request->description
            ]);

            // Save Image in Storage folder
            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            // Return Json Response
            return response()->json([
                'message' => "Product successfully created."
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found!'
                ], 404);
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;

            if ($request->image) {
                $storage = Storage::disk('public');
                // delete old image
                if ($storage->exists($product->image)) {
                    $storage->delete($product->image);
                }

                // Image name
                $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                $product->image = $imageName;

                // Image save in public folder
                $storage->put($imageName, file_get_contents($request->image));
            }

            //Update Product
            $product->save();

            return response()->json([
                'message' => 'Product successfully updated!'
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'message' => 'Product not found!'
                ], 404);
            }

            $storage = Storage::disk('public');
            // delete old image
            if ($storage->exists($product->image)) {
                $storage->delete($product->image);
            }

            // Delete Product
            $product->delete();

            return response()->json([
                'message' => 'Product successfully deleted!'
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Product::where('name', 'like', '%' . $name . '%')->get();
    }
}
