<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


class ReportControllerTest extends TestCase
{
    // public function testSendDailySalesReport()
    // {
    //     // Mock the Mailable class to prevent actual email sending
    //     Mail::fake();

    //     $seller = Seller::factory()
    //         ->has(Order::factory()->count(5))
    //         ->create();

    //     // Define your test data (seller ID and date)
    //     $sellerId = $seller->id;
    //     $date = '2023-09-20';

    //     // Call the endpoint to send the daily sales report
    //     $response = $this->post("/api/reports/sellers/{$sellerId}", ['date' => $date]);

    //     // Assert that the response is successful
    //     $response->assertStatus(200);

    //     // Assert that the email was sent
    //     Mail::assertSent(DailySalesReport::class, function ($mail) use ($sellerId, $date) {
    //         // Perform assertions on the email content, recipients, etc.
    //         return $mail->hasTo('seller@example.com') &&
    //             $mail->sellerReport->sellerId === $sellerId &&
    //             $mail->sellerReport->date === $date;
    //     });
    // }
}
