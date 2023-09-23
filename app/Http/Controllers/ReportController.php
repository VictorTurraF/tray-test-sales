<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ReportController extends Controller
{
    public function sendDailySalesReport(Request $request, $sellerId)
    {
        // Retrieve the date from the request data (if provided)
        $date = $request->input('date', now()->format('Y-m-d'));

        // Run the Artisan command to send the daily sales report
        Artisan::call('app:send-daily-sales-report-to-seller', [
            'seller_id' => $sellerId,
            '--date' => $date,
        ]);

        // Get the output of the Artisan command
        $output = Artisan::output();

        // You can return a response or perform any desired action with the output
        return response()->json(['message' => 'Daily sales report sent successfully', 'output' => $output]);
    }
}
