<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends ApiController
{

    // Warranties index
    public function index(Request $request)
    {
        if($request->user()->can('read.warranty'))
        {
                $warranties = Warranty::orderby('id', 'desc')->paginate(2);
                return $this->success_response($warranties);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Show specific Warranty
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.warranty'))
        {
            $warranty = Warranty::find($id);
            return $this->success_response($warranty);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Store a new Warranty
    public function store(Request $request)
    {
        if($request->user()->can('create.warranty'))
        {
            $warranty = Warranty::create($request->toArray());
            return $this->success_response($warranty);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update Warranty
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.warrany'))
        {
            $warranty = Warranty::find($id)->update($request->toArray());
            return $this->success_response($warranty);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Destroy Warranties
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.warranty'))
        {
            Warranty::destroy($id);
            return $this->delete_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }
}
