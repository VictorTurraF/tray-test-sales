<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllOrdersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testShouldListAllOrders(): void
    {
        // Create a few order records in the database using the factory
        $orders = Order::factory()->count(5)->create();

        // Send a GET request to your order listing endpoint
        $response = $this->get('/api/orders'); // Replace with your actual endpoint

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response JSON contains the list of orders
        $response->assertJsonCount(5, 'data'); // Assuming you created 5 orders

        // Additional assertions:
        // Check the price_in_cents of the first order in the response
        $firstOrder = $orders->first();
        $response->assertJsonFragment([
            'price_in_cents' => $firstOrder->price_in_cents,
        ]);

        // Check the price_in_cents of the last order in the response
        $lastOrder = $orders->last();
        $response->assertJsonFragment([
            'price_in_cents' => $lastOrder->price_in_cents,
        ]);
    }
}
