<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{

    // Categories index
    public function index(Request $request)
    {
        if($request->user()->can('read.category'))
        {
            $categories = Category::orderby('id', 'desc')->paginate(5);
            return $this->success_response($categories);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Show specific Category
    public function show(Request $request, string $id)
    {
        if($request->user()->can('read.category'))
        {
            $category = Category::find($id);
            return $this->success_response($category);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Store a new Category
    public function store(Request $request)
    {
        if($request->user()->can('create.category'))
        {
        $category = Category::create($request->toArray());
        return $this->success_response($category);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update Category
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.category'))
        {
        $category = Category::find($id)->update($request->toArray());
        return $this->success_response($category);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Destroy Categories
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.category'))
        {
            Category::destroy($id);
            return $this->delete_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }
}
