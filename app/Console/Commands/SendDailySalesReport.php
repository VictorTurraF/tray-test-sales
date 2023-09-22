<?php

namespace App\Console\Commands;

use App\Mail\DailySalesReport;
use App\Models\Order;
use App\Models\Seller;
use App\Services\SellerReportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailySalesReport extends Command
{
    protected $signature = 'app:send-daily-sales-report';
    protected $description = 'Send daily sales report to sellers';

    public function __construct(
        protected SellerReportService $sellerReportService
    )
    {
        parent::__construct();
    }

    public function handle()
    {
        $date = now()->format('Y-m-d');
        $sellers = Seller::all();

        foreach ($sellers as $seller) {
            $report = $this->sellerReportService->generateDailySalesReport($seller, $date);

            // Send an email to the seller
            Mail::to($seller->email)
                ->send(new DailySalesReport($report));
        }
        $this->info('Daily sales report sent successfully.');
    }
}
