<?php

namespace Tests\Feature;

use Database\Factories\SellerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListAllSellersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testShouldListAllSellers(): void
    {
        // Create a few seller records in the database using the factory
        $sellers = SellerFactory::new()->count(5)->create();

        // Send a GET request to your seller listing endpoint
        $response = $this->get('/api/sellers'); // Replace with your actual endpoint

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response JSON contains the list of sellers
        $response->assertJsonCount(5, 'data'); // Assuming you created 5 sellers

        // Additional assertion: Check the name of the first seller in the response
        $firstSeller = $sellers->first();
        $response->assertJsonFragment([
            'name' => $firstSeller->name,
        ]);
    }
}
