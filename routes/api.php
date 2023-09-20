<?php

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
