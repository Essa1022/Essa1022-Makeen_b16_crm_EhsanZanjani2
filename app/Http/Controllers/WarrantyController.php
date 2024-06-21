<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{

    // Warranties index
    public function index(Request $request)
    {
        if($request->user()->can('read.warranty'))
        {
                $warranties = Warranty::orderby('id', 'desc')->paginate(2);
                return $this->responseService->success_response($warranties);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Warranty
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.warranty'))
        {
            $warranty = Warranty::find($id);
            return $this->responseService->success_response($warranty);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Warranty
    public function store(Request $request)
    {
        if($request->user()->can('create.warranty'))
        {
            $warranty = Warranty::create($request->toArray());
            return $this->responseService->success_response($warranty);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Warranty
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.warrany'))
        {
            $warranty = Warranty::find($id)->update($request->toArray());
            return $this->responseService->success_response($warranty);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Warranties
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.warranty'))
        {
            Warranty::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
