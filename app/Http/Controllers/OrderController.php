<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->all();

        return response()->json([
            "data" => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'seller_id',
            'price_in_cents',
            'payment_approved_at'
        ]);

        $order = $this->orderRepository->create($data);

        return response()->json([
            'data' => $order
        ], 201);
    }
}
