<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id = null)
    {
        if(!$id)
    {
        $products = Product::orderby('id', 'desc')->paginate(2);
        return response()->json($products);
    }
    else
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create($request->toArray());
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $product)
    // {
    //     $product = Product::find($product);
    //     return response()->json($product);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, string $id)
    {
        $product = Product::find($id)->update($request->toArray());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::destroy($id);
        return response()->json($product);
    }
}

