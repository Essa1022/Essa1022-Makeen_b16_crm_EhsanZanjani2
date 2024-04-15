<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderby('desc', 'id')->paginate(2);
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $product = Product::create($request->toArray());
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product)
    {
        $product = Product::find($product);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $product)
    {
        $product = Product::where('id', $product)->update($request->toArray());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product)
    {
        $product = Product::destroy($product);
        return response()->json($product);
    }
}

