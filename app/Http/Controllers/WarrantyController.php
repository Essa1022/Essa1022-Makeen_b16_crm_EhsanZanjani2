<?php

namespace App\Http\Controllers;

use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.warranty'))
        {
            if(!$id)
            {
                $warranties = Warranty::orderby('id', 'desc')->paginate(2);
                return response()->json($warranties);
            }
            else
            {
                $warranty = Warranty::find($id);
                return response()->json($warranty);
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
        if($request->user()->can('create.warranty'))
        {
            $warranty = Warranty::create($request->toArray());
            return response()->json($warranty);
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
        if($request->user()->can('update.warrany'))
        {
            $warranty = Warranty::find($id)->update($request->toArray());
            return response()->json($warranty);
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
        if($request->user()->can('delete.warranty'))
        {
            Warranty::destroy($id);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
