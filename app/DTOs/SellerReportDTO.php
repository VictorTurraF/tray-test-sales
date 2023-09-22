<?php

namespace App\DTOs;

class SellerReportDTO
{
    public $sellerName;
    public $date;
    public $totalSales;
    public $totalCommissions;

    public function __construct($sellerName, $date, $totalSales, $totalCommissions)
    {
        $this->sellerName = $sellerName;
        $this->date = $date;
        $this->totalSales = $totalSales;
        $this->totalCommissions = $totalCommissions;
    }
}
