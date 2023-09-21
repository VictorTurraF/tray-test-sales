<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testShouldCreateAnOrderGivenSellerIdAndDateAndPrice(): void
    {
        // Create a seller in the database
        $seller = Seller::factory()->create();

        // Define the order data
        $data = [
            'seller_id' => $seller->id,
            'price_in_cents' => 1000, // Adjust the price as needed
            'payment_approved_at' => now()->toDateString(), // Use the current date
        ];

        // Send a POST request to your order creation endpoint
        $response = $this->post('/api/orders', $data);

        // Assert that the order was successfully created
        $response->assertStatus(201);

        // Assert that the order exists in the database
        $this->assertDatabaseHas('orders', $data);

        // Optionally, assert that the response JSON contains the expected data
        $response->assertJson([
            'data' => $data,
        ]);

        // Retrieve the created order from the database
        $createdOrder = Order::where($data)->first();

        // Assert that the "id" in the response matches the created order's ID
        $this->assertEquals($createdOrder->id, $response->json('data.id'));
    }
}
