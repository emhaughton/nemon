<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexedPriceController;
use App\Http\Controllers\ListConsumptionsController;

Route::post('/indexed-price', IndexedPriceController::class);
Route::get('/consumptions',ListConsumptionsController::class);