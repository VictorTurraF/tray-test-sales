<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Order;

class SellerOrderController extends Controller
{
    public function index($sellerId)
    {
        // Retrieve the seller record
        $seller = Seller::find($sellerId);

        if (!$seller) {
            return response()->json(['message' => 'Seller not found'], 404);
        }

        // Retrieve the orders associated with the seller
        $orders = Order::where('seller_id', $sellerId)->get();

        return response()->json(['data' => $orders], 200);
    }
}
