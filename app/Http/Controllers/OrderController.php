<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\EdiOrdertRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id = null)
    {
        if(!$id)
        {
            $orders = Order::with(['products:id,product_name'])
            ->orderby('id', 'desc')->paginate(2);
            return response()->json($orders);
        }
        else
        {
            $order = Order::with(['products:id,product_name'])->find($id);
            return response()->json($order);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $order = Order::create($request->toArray());
        $extras = $request->input('extra');
        $warranty_expires_at = Carbon::now()->addMonth(12);
        foreach($extras as $extra){
            $order->products()->attach($extra['id'],
            ["quantity" => $extra['quantity'], "warranty_expires_at" => $warranty_expires_at]);
        }
         return response()->json($order);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $order)
    // {
    //     $order = Order::with(['user:id,username', 'products:id,product_name'])->find($order);
    //     return response()->json($order);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdiOrdertRequest $request, string $id)
    {
        $order = Order::find($id)->update($request->toArray());
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::destroy($id);
        return response()->json($order);
    }
}

