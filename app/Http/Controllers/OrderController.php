<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\EditOrdertRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\FlareClient\Api;

class OrderController extends Controller
{

    // Orders index
    public function index(Request $request)
    {
        if($request->user()->can('read.order'))
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
                return $this->responseService->success_response($orders);
//              return OrderResource::collection($orders);
        }
        else
        {
                $orders = Order::where('user_id', $request->user()->id)->with(['products:id,product_name'])
                ->orderby('id', 'desc')->paginate(2);
                return $this->responseService->success_response($orders);
        }
        return $this->responseService->unauthorized_response();
    }

    // Show specific Order
    public function show(Request $request, $id)
    {
        if($request->user()->can('read.order'))
        {
            $order = Order::with(['products:id,product_name'])->find($id);
            return $this->responseService->success_response($order);
//          return OrderResource::make($order);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Order
    public function store(CreateOrderRequest $request)
    {
        if ($request->user()->can('create.order'))
        {
            $products = array_map(function ($product)
            {
                return is_array($product) ? (object) $product : $product;
            }, $request->input('products'));

            $total = 0;
            foreach ($products as $product)
            {
                $total += Product::find($product->id)->price * $product->quantity;
            }

            $order = Order::create($request->merge([
                "total_amount" => $total,
                "status" => 1
            ])->toArray());

            foreach ($products as $productItem)
            {
                $product = Product::find($productItem->id);
                $warranties = $product->warranties->map(function ($warranty)
                {
                    return [
                        'warranty_id' => $warranty['id'],
                        'warranty_starts_at' => Carbon::now(),
                        'warranty_expires_at' => Carbon::now()->addDays($warranty['expiration'])
                    ];
                });
                $order->products()->attach($product->id, [
                    "quantity" => $productItem->quantity,
                    'warranties' => $warranties
                ]);
            }
            return $this->responseService->success_response($order);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Order
    public function update(EditOrdertRequest $request, string $id)
    {
        if($request->user()->can('update.order'))
        {
        $order = Order::find($id)->update($request->toArray());
        return $this->responseService->success_response($order);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Orders
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.order'))
        {
            Order::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Change Status
    public function change_status(Request $request, string $order_id, int $status)
    {
        if($request->user()->can('update.order'))
        {
            $order = Order::find($order_id)->update(['status' => $status]);
            return $this->responseService->success_response($order);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}

