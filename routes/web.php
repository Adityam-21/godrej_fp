<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Main category/subcategory page
Route::get('/{category}/{subcategory}', [HomeController::class, 'index'])->name('index');

// Product detail page
Route::get('/refrigerator/{slug}', [HomeController::class, 'show'])->name('product.show');

// You might also want to add a default route
Route::get('/', function () {
    return redirect('/home/welcome');
});