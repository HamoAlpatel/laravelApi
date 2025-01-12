<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductCollection::collection(Product::Paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // $product = new Product;

        // $product->name = $request->name;
        // $product->detail = $request->detail;
        // $product->price = $request->price;
        // $product->discount = $request->discount;
        // $product->stock = $request->stock;
        // $product->save();

        // return ProductCollection::collection(Product::Paginate(20));

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $product = new Product;
        $product->name = $validatedData['name'];
        $product->detail = $validatedData['detail'];
        $product->price = $validatedData['price'];
        $product->discount = $validatedData['discount'];
        $product->stock = $validatedData['stock'];
        $product->save();

        return response()->json(['message' => 'Product created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // return $product;
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Product $product)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return 'ddddddddd';
    }
    // $validatedData = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'detail' => 'required|string',
    //     'price' => 'required|numeric|min:0',
    //     'discount' => 'nullable|numeric|min:0|max:100',
    //     'stock' => 'required|integer|min:0',
    // ]);

    // $product = Product::findOrFail($product);
    // $product->name = $validatedData['name'];
    // $product->detail = $validatedData['detail'];
    // $product->price = $validatedData['price'];
    // $product->discount = $validatedData['discount'];
    // $product->stock = $validatedData['stock'];
    // $product->save();
    // return response()->json(['message' => 'Product updated successfully']);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $id = $product->id;
        $product->destroy($id);
        return ProductCollection::collection(Product::Paginate(20));
    }
}
