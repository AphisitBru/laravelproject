<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculator', function () {
    return view('pages.calculator');
});

Route::get('/customer/define', function () {
    return view('pages.customer.define');
});

Route::get('/customer/detail', function () {
    return view('pages.customer.detail');
});

// API Routes สำหรับ Customers
Route::prefix('api/customers')->group(function () {
    Route::post('/search', [CustomerController::class, 'findByCardID']);
    Route::get('/cardID/{cardID}', [CustomerController::class, 'showByCardID']);
    Route::put('/cardID/{cardID}', [CustomerController::class, 'updateByCardID']);
});