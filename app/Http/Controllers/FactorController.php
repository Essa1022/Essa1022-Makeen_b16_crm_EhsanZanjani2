<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class FactorController extends ApiController
{

    // Factors index
    public function index(Request $request)
    {
        if($request->user()->can('read.factor'))
        {
            $factors = Factor::orderby('id', 'desc')->paginate(5);
            return $this->success_response($factors);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Show specific Factor
    public function show(Request $request, string $id)
    {
        if($request->user()->can('read.factor'))
        {
            $factor = Factor::find($id);
            return $this->success_response($factor);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Store a new Factor
    public function store(Request $request)
    {
        if($request->user()->can('create.factor'))
        {
        $factor = Factor::create($request->toArray());
        return $this->success_response($factor);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Update Factor
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.factor'))
        {
            $factor = Factor::find($id)->update();
            return $this->success_response($factor);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Destroy Factors
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.factor'))
        {
            Factor::destroy($id);
            return $this->delete_response();
        }
        else
        {
            return $this->unauthorized_response();
        }
    }
}
