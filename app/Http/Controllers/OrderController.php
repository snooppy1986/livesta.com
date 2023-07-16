<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOptions;
use App\Models\Order;
use App\Models\orderProduct;
use App\Models\OrderUser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    public function show(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order_product = orderProduct::with('product')->where('order_id', $request->order_id)->get();

        return response()->json([
            'order_products'=>$order_product,
            'order'=>$order
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required | min: 3 | max: 255 | string',
            'surname'=>'required | min: 3 | max: 255 | string',
            'phone'=>'required | numeric | digits:10',
            'email'=>'max: 255 | string',
            'notes'=>'max: 1024',
            'products'=> 'array'
        ]);

        //create order
        $order = Order::create($data);

        //create order products
        foreach ($data['products'] as $product){
            orderProduct::create([
                'order_id'=> $order->id,
                'product_id'=> $product['product']['id'],
                'qty' => $product['qty']
            ]);
        }

        //create user info
        if($request->user_id){
             OrderUser::create([
                'order_id' => $order->id,
                'user_id' => $request->user_id
            ]);
        }

        //delivery options
        DeliveryOptions::create([
            'order_id' => $order->id,
            'type' => $request->deliveryMethod,
            'area' => $request->deliveryAddress ? $request->deliveryAddress['area'] : null,
            'city' => $request->deliveryAddress ? $request->deliveryAddress['city'] : null,
            'warehouse' => $request->deliveryAddress ? $request->deliveryAddress['warehouses'] : null,
            'payment_type' => $request->paymentMethod
        ]);

        return response()->json(['status'=>true]);
    }
}
