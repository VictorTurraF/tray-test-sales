<?php

namespace App\Console\Commands;

use App\Mail\DailySalesReport;
use App\Models\Seller;
use App\Services\SellerReportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailySalesReportToSeller extends Command
{

    protected $signature = 'app:send-daily-sales-report-to-seller {seller_id} {--date=}';
    protected $description = 'Send daily sales report to a specific seller';

    public function __construct(
        protected SellerReportService $sellerReportService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $sellerId = $this->argument('seller_id');
        $date = $this->option('date') ?: now()->format('Y-m-d');

        // Retrieve the seller by seller_id
        $seller = Seller::findOrFail($sellerId);

        // Generate the daily sales report for the seller
        $report = $this->sellerReportService->generateDailySalesReport($seller, $date);

        // Send an email to the seller
        Mail::to($seller->email)
            ->send(new DailySalesReport($report));

        $this->info("Daily sales report sent to Seller ID: $sellerId successfully.");
    }
}
