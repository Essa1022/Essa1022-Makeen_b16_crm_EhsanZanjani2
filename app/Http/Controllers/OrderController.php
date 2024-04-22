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
    public function index()
    {
        $orders = Order::with(['user:id,username', 'products:id,product_name'])
        ->orderby('id', 'desc')->paginate(2);
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $order = Order::create($request->toArray());
        $extra = $request->input('extra');
        $wExpireAt =Carbon::now()->addMonth(12);
        foreach($extra as $ex){
            $order->products()->attach($ex['id'],
            ["quantity" => $ex['quantity'], "wExpireAt" => $wExpireAt]);
        }
         return response()->json($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $order)
    {
        $order = Order::with(['user:id,username', 'products:id,product_name'])->find($order);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EdiOrdertRequest $request, string $order)
    {
        $order = Order::where('id', $order)->update($request->toArray());
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $order)
    {
        $order = Order::destroy($order);
        return response()->json($order);
    }
}
