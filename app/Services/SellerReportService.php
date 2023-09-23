<?php

namespace App\Services;

use App\DTOs\SellerReportDTO;
use App\Models\Order;
use App\Models\Seller;

class SellerReportService
{
    public function generateDailySalesReport(Seller $seller, $date)
    {
        // Calculate total sales and commissions for the seller
        $totalSales = Order::where('seller_id', $seller->id)->where('payment_approved_at', $date)->sum('price_in_cents');
        $totalCommissions = $totalSales * (8.5 / 100);

        return new SellerReportDTO(
            $seller->name,
            $date,
            $totalSales,
            $totalCommissions
        );
    }
}
