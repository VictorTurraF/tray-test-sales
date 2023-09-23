<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::all();

        return response()->json([
            "data" => $sellers
        ], 200);
    }

    public function store(Request $request)
    {
        $sellerName = $request->input("name");
        $sellerEmail = $request->input("email");

        $seller = new Seller([
            'name' => $sellerName,
            'email' => $sellerEmail
        ]);

        $seller->save();

        return response()->json([
            'data' => [
                'id' => $seller->id,
                'name' => $seller->name,
                'email' => $seller->email,
            ]
        ], 201);
    }
}
