<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Demo routes for lab report (facades)
Route::get('/demo/rate', function () {
    $usd = CurrencyRate::rate('USD');
    $eur = CurrencyRate::rate('EUR');
    return response()->json([
        'base' => config('abstract-shop.currency.base'),
        'provider' => config('abstract-shop.currency.provider'),
        'USD' => $usd,
        'EUR' => $eur,
    ], 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
});

Route::get('/demo/delivery', function () {
    $from = request('from', 'Москва');
    $to = request('to', 'Тверь');
    $estimate = DeliveryCost::estimate($from, $to);
    return response()->json([
        'provider' => config('abstract-shop.delivery.provider'),
        'from' => $from,
        'to' => $to,
        'estimate' => $estimate,
    ], 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
});
