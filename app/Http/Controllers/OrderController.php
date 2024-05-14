<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\EdiOrdertRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.order'))
        {
            if(!$id)
            {
                $phone_number = $request->phone_number;
                $orders = new Order();
                $orders = $orders->with(['products:id,product_name']);
                if ($request->phone_number)
                {
                    $orders = $orders->whereHas('user', function(Builder $querry) use($phone_number)
                    {
                        $querry->where('phone_number', $phone_number);
                    });
                }
                $orders = $orders->orderby('id', 'desc')->paginate(10);
                return response()->json($orders);
            }
            else
            {
                $order = Order::with(['products:id,product_name'])->find($id);
                return response()->json($order);
            }
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
        {
            if(!$id)
                {
                    $orders = Order::where('user_id', $request->user()->id)->with(['products:id,product_name'])
                    ->orderby('id', 'desc')->paginate(2);
                    return response()->json($orders);
                }
            else
            {
                return response()->json('Order not found', 404);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        if($request->user()->can('create.order'))
        {
            $products = array_map(function ($product) {
                return is_array($product)? (object) $product : $product;
            }, $request->input('products'));
            $total = 0;
            foreach($products as $product)
            {
                $total += Product::find($product->id)->price * $product->quantity;
            }
            $order = Order::create($request->merge(["total_amount" => $total])->toArray());
            foreach($products as $product)
            {
                $product = Product::find($product->id);
                $warranties = $product->warranties;
                foreach($warranties as $warranty)
                {
                    $warranty_expires_at = Carbon::now()->addDays($warranty->expiration);
                }

                foreach($products as $product)
                {
                    $order->products()->attach($product->id,
                    ["quantity" => $product->quantity, "warranty_expires_at" => $warranty_expires_at,
                    "warranty_starts_at" => Carbon::now()]);
                }
            }
            return response()->json($order);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
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
        if($request->user()->can('update.order'))
        {
        $order = Order::find($id)->update($request->toArray());
        return response()->json($order);
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
        if($request->user()->can('delete.order'))
        {
        $order = Order::destroy($id);
        return response()->json($order);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}

