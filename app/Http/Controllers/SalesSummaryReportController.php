<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SalesSummaryReportController extends Controller
{
    public function sendSalesSummary(Request $request)
    {
        $email = $request->input('email');

        // Trigger the command to send the sales summary report to the specified email
        Artisan::call('app:send-daily-sales-summary', ['email' => $email]);

        return response()->json(['message' => 'Sales summary report sent successfully'], 200);
    }
}
