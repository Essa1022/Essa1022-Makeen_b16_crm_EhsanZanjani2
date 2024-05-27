<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.category'))
        {
        if(!$id)
        {
            $categories = Category::orderby('id', 'desc')->paginate(2);
            return response()->json($categories);
        }
        else
        {
            $category = Category::find($id);
            return response()->json($category);
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
        if($request->user()->can('create.category'))
        {
        $category = Category::create($request->toArray());
        return response()->json($category);
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
        if($request->user()->can('read.category'))
        {
        $category = Category::find($id)->update($request->toArray());
        return response()->json($category);
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
        if($request->user()->can('read.category'))
        {
            Category::destroy($id);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
