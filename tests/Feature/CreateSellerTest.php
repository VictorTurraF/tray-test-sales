<?php

namespace Tests\Feature;

use App\Models\Seller; // Import the Seller model
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSellerTest extends TestCase
{
    use RefreshDatabase; // Refresh the database after each test

    /**
     * A basic feature test example.
     */
    public function testShouldCreateASellerByGivenNameAndEmail(): void
    {
        $name = 'John Doe';
        $email = 'johndoe@example.com';

        $response = $this->post('/api/sellers', [
            'name' => $name,
            'email' => $email,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $name,
                    'email' => $email,
                ],
            ]);

        $this->assertDatabaseHas('sellers', [
            'name' => $name,
            'email' => $email,
        ]);

        $createdSeller = Seller::where('email', $email)->first();

        $this->assertEquals($name, $createdSeller->name);
        $this->assertEquals($email, $createdSeller->email);

        $response->assertJson([
            'data' => [
                'id' => $createdSeller->id
            ]
        ], true);
    }
}
