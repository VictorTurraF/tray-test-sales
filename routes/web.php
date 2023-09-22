<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return Inertia::render('HomePage');
});

Route::get('/vendedores', function () {
  return Inertia::render('SellerList');
});

Route::get('/vendedores/cadastrar', function () {
  return Inertia::render('AddSeller');
});

Route::get('/vendas', function () {
  return Inertia::render('OrderList');
});

Route::get('/vendas/cadastrar', function () {
  return Inertia::render('AddOrder');
});

Route::get('/vendedores/{seller_id}/vendas', function ($sellerId) {
  return Inertia::render('OrdersBySellerList', [
    'sellerId' => $sellerId
  ]);
});

require __DIR__ . '/auth.php';
