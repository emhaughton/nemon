<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexedPriceController;

Route::post('/indexed-price', IndexedPriceController::class);