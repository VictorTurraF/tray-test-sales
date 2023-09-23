<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SellerOrderRepository;

class SellerOrderController extends Controller
{
    protected $sellerOrderRepository;

    public function __construct(SellerOrderRepository $sellerOrderRepository)
    {
        $this->sellerOrderRepository = $sellerOrderRepository;
    }

    public function index($sellerId)
    {
        $orders = $this->sellerOrderRepository->getOrdersBySellerId($sellerId);

        if (!$orders) {
            return response()->json(['message' => 'Seller not found'], 404);
        }

        return response()->json(['data' => $orders], 200);
    }
}
