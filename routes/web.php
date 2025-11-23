<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderPdfController;

Route::get('/pedido/{record}/pdf', [OrderPdfController::class, 'download'])->name('order.pdf');

Route::get('/', function () {
    return view('welcome');
});
