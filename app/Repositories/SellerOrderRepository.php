<?php

namespace App\Repositories;

use App\Models\Seller;
use App\Models\Order;

class SellerOrderRepository
{
    public function getOrdersBySellerId($sellerId)
    {
        // Retrieve the seller record
        $seller = Seller::find($sellerId);

        if (!$seller) {
            return null; // Return null or handle the error as needed
        }

        // Retrieve the orders associated with the seller
        return Order::where('seller_id', $sellerId)->get();
    }
}
