<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Order;
use Illuminate\Http\Request;

class FactorController extends Controller
{

    // Factors index
    public function index(Request $request)
    {
        if($request->user()->can('read.factor'))
        {
            $factors = Factor::orderby('id', 'desc')->paginate(5);
            return $this->responseService->success_response($factors);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Factor
    public function show(Request $request, string $id)
    {
        if($request->user()->can('read.factor'))
        {
            $factor = Factor::find($id);
            return $this->responseService->success_response($factor);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Factor
    public function store(Request $request)
    {
        if($request->user()->can('create.factor'))
        {
        $factor = Factor::create($request->toArray());
        return $this->responseService->success_response($factor);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Factor
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.factor'))
        {
            $factor = Factor::find($id)->update();
            return $this->responseService->success_response($factor);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Factors
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.factor'))
        {
            Factor::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Change Status
    public function change_status(Request $request, string $factor_id, int $status)
    {
        if($request->user()->can('update.order'))
        {
            $factor = Factor::find($factor_id)->update(['status' => $status]);
            return $this->responseService->success_response($factor);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
