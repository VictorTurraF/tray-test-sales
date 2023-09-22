<?php

namespace App\Console\Commands;

use App\Mail\DailySalesSummary;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailySalesSummary extends Command
{

    protected $signature = 'app:send-daily-sales-summary {email}';
    protected $description = 'Send daily sales summary to system administrator';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = now()->format('Y-m-d');
        $email = $this->argument('email');

        // Calculate total sales for the day
        $totalSales = Order::whereDate('payment_approved_at', $date)->sum('price_in_cents');

        // Send an email to the system administrator with the total sales
        Mail::to($email)->send(new DailySalesSummary($totalSales));

        $this->info('Daily sales summary sent successfully.');
    }
}
