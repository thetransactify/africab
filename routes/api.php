<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SheetProductController;

// Test route
Route::get('/ping', function () {
    return response()->json(['status' => 'ok']);
});

// Google Sheet update route
Route::post('/update-product', [SheetProductController::class, 'updateFromSheet']);
