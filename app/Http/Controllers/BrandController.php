<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.brand'))
        {
            if(!$id)
            {
                $brands = Brand::orderby('id', 'desc')->paginate(2);
                return response()->json($brands);
            }
            else
            {
                $brand = Brand::find($id);
                return response()->json($brand);
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
    public function store(Request $request)
    {
        if($request->user()->can('create.brand'))
        {
        $brand = Brand::create($request->toArray());
        return response()->json($brand);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->user()->can('read.brand'))
        {
        $brand = Brand::find($id)->update($request->toArray());
        return response()->json($brand);
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
        if($request->user()->can('read.brand'))
        {
            Brand::destroy($id);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
