<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        return new ProductCollection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @return Product
     */
    public function store(StoreProductRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $product = new Product;
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->save();
        return $product;
    }


    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return Product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "message" => "Data Eliminada"
        ], 204);
    }
}
