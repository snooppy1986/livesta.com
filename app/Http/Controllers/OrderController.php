<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\CartItem;
use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\orderProduct;
use App\Models\OrderUser;
use App\Models\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{

    public function show(Request $request)
    {
        //get order id
        $id = $request->order_id;
        //get order
        $order = Order::where('id', $id)->first();


        return response()->json([
            'order'=> new OrderResource($order)
        ]);
    }
    public function store(OrderStoreRequest $request)
    {
        $data = $request->validated();

        //create order
        $order = Order::create($data);

        //create product info
        $order->product()
            ->attach($data['products_ids']);

        //create user info
        if($data['user_id'])
             $order->users()->attach($data['user_id']);

        //delivery options
        $order->create_delivery_method($data);

        //cart_item
        $order->create_item($data['products']);

        return response()->json(['status'=>true]);
    }
}
