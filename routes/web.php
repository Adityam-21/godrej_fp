<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Landing page or product-specific landing page via optional slug
Route::get('/{slug?}', [HomeController::class, 'index'])->name('index');

// AJAX search route
Route::get('/search-products', [HomeController::class, 'search'])->name('search.products');

// AJAX dynamic section loader
Route::get('/section/{slug}', [HomeController::class, 'loadProductSection'])->name('section.load');
Route::post('/import-products', [HomeController::class, 'import'])->name('products.import');
