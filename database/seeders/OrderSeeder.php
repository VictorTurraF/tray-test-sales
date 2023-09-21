<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Get all sellers
    $sellers = Seller::all();

    // Loop through each seller and create 10 orders for each
    foreach ($sellers as $seller) {
      Order::factory()
        ->count(10)
        ->create([
          'seller_id' => $seller->id
        ]);
    }
  }
}
