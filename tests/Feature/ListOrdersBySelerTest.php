<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListOrdersBySelerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testShouldListAllOrdersOfAnSpecificSellerId(): void
    {
        // Create a seller record in the database using the factory
        $seller = Seller::factory()->create();

        // Create a few order records associated with the seller using the factory
        $orders = Order::factory()->count(5)->create([
            'seller_id' => $seller->id,
        ]);

        // Send a GET request to your order listing endpoint for the specific seller's orders
        $response = $this->get('/api/sellers/' . $seller->id . '/orders'); // Replace with your actual endpoint

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response JSON contains the list of orders for the specific seller
        $response->assertJsonCount(5, 'data'); // Assuming you created 5 orders for this seller

        // Additional assertions:
        // Check the details of the first order in the response
        $firstOrder = $orders->first();
        $response->assertJsonFragment([
            'price_in_cents' => $firstOrder->price_in_cents,
            'payment_approved_at' => $firstOrder->payment_approved_at,
        ]);

        // Check the details of the last order in the response
        $lastOrder = $orders->last();
        $response->assertJsonFragment([
            'price_in_cents' => $lastOrder->price_in_cents,
            'payment_approved_at' => $lastOrder->payment_approved_at,
        ]);
    }
}
