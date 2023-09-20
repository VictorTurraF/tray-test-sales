<?php

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sellers', function (Request $request) {

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
});

Route::get('/sellers', function () {
    $sellers = Seller::all();

    return response()->json([
        "data" => $sellers
    ], 200);
});

Route::post('/orders', function (Request $request) {

    $fields = $request->only([
        'seller_id',
        'price_in_cents',
        'payment_approved_at'
    ]);

    $order = new Order($fields);

    $order->save();

    return response()->json([
        'data' => $order
    ], 201);
});
