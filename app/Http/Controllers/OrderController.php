<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return response()->json([
            "data" => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        $fields = $request->only([
            'seller_id',
            'price_in_cents',
            'payment_approved_at'
        ]);

        $order = new Order($fields);
        $order->save();

        return response()->json([
            'data' => $order
        ], 201);
    }
}
