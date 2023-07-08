<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getOrderProduct(Request $request)
    {

        return response()->json($request->data);
    }
}
