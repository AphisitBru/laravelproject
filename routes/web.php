<?php

use Illuminate\Support\Facades\Route;

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
