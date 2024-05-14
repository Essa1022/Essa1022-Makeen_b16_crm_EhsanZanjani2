<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.factor'))
        {
        if(!$id)
        {
            $factors = Factor::orderby('id', 'desc')->paginate(2);
            return response()->json($factors);
        }
        else
        {
            $factor = Factor::find($id);
            return response()->json($factor);
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
        if($request->user()->can('read.factor'))
        {
        $factor = Factor::create($request->toArray());
        return response()->json($factor);
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
        if($request->user()->can('read.factor'))
        {
            $factor = Factor::find($id)->update();
            return response()->json($factor);
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
        if($request->user()->can('read.factor'))
        {
        $factor = Factor::destroy($id);
        return response()->json($factor);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
