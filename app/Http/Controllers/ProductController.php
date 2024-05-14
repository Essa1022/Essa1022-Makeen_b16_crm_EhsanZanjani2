<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.product'))
        {
            if(!$id)
            {
                $products = new Product();
                $products = $products->with(['category:id,title', 'brand', 'warranties', 'labels']);
                if($request->most_sold)
                {
                    $products = $products->withCount('orders');
                    $products = $products->orderBy('orders_count', 'desc');
                    $products = $products->skip(0)->take(3);
                    $products = $products->get();
                    return response()->json($products);
                }
                $products = $products->orderby('id', 'desc')->paginate(5);
                return response()->json($products);
            }
            else
            {
                $product = Product::with(['category:id,title', 'brand', 'warranties', 'labels'])->find($id);
                return response()->json($product);
            }
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        if($request->user()->can('create.product'))
        {
            $path = $request->file('image_path')->store('public/products');
            $product = Product::create($request->merge(["image_path" => $path])->toArray());
            $product->warranties()->attach($request->warranty_ids);
            $product->labels()->attach($request->label_ids);
            return response()->json($product);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
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
        if($request->user()->can('update.product'))
        {
            $product = Product::find($id)->update($request->toArray());
            return response()->json($product);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.product'))
        {
            $product = Product::destroy($id);
            return response()->json($product);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}

