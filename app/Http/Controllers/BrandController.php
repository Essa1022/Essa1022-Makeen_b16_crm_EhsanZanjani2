<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    //  Brands index
    public function index(Request $request)
    {
        if($request->user()->can('read.brand'))
        {
            $brands = Brand::orderby('id', 'desc')->paginate(5);
            return $this->responseService->success_response($brands);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Brand
    public function show(Request $request, string $id)
    {
        if($request->user()->can('read.brand'))
        {
            $brand = Brand::find($id);
            return $this->responseService->success_response($brand);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Brand
    public function store(Request $request)
    {
        if($request->user()->can('create.brand'))
        {
        $brand = Brand::create($request->toArray());
        return $this->responseService->success_response($brand);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Brand
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.brand'))
        {
        $brand = Brand::find($id)->update($request->toArray());
        return $this->responseService->success_response($brand);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Brands
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.brand'))
        {
            Brand::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
