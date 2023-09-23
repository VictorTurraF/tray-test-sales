<?php

namespace App\Repositories;

use App\Models\Seller;

class SellerRepository
{
    public function all()
    {
        return Seller::all();
    }

    public function create(array $data)
    {
        return Seller::create($data);
    }
}
