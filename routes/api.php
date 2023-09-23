<?php
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

use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesSummaryReportController;

Route::post('/sellers', [SellerController::class, 'store']);
Route::get('/sellers', [SellerController::class, 'index']);

Route::get('/sellers/{seller}/orders', [SellerOrderController::class, 'index']);

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index']);

Route::post('/reports/sellers/{seller_id}', [ReportController::class, 'sendDailySalesReport']);
Route::post('/reports/sales-summary', [SalesSummaryReportController::class, 'sendSalesSummary']);
