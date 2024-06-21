<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductController extends Controller
{

    // Products index
    public function index(Request $request)
    {
        if($request->user()->can('read.product'))
        {
                $products = new Product();
                $products = $products->with(['category:id,title', 'brand', 'warranties', 'labels']);
                if($request->most_sold)
                {
                    $products = $products
                    ->withCount('orders')
                    ->orderBy('orders_count', 'desc')
                    ->skip(0)->take(3)
                    ->get();
                    return $this->responseService->success_response($products);
                }
                $products = $products->orderby('id', 'desc')->paginate(5);
                return $this->responseService->success_response($products);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Product
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.product'))
        {
            $product = Product::with(['category:id,title', 'brand', 'warranties', 'labels'])->find($id);
            return $this->responseService->success_response($product);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Product
    public function store(CreateProductRequest $request)
    {
        if($request->user()->can('create.product'))
        {
            $product = Product::create($request->toArray());
            $product->warranties()->attach($request->warranty_ids);
            $product->labels()->attach($request->label_ids);
            return $this->responseService->success_response($product);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Product
    public function update(EditProductRequest $request, string $id)
    {
        if($request->user()->can('update.product'))
        {
            $product = Product::find($id)->update($request->toArray());
            return $this->responseService->success_response($product);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Products
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.product'))
        {
            Product::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}

