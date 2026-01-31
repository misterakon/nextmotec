<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\Crm;
use App\Http\Controllers\backend\dashboard\Analytics;
use App\Http\Controllers\backend\language\LanguageController;
use App\Http\Controllers\frontend\ProductController;

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/', [ProductController::class, 'index'])
    ->name('products.index');

// Route::get('/products/{product}/details', [ProductController::class, 'details'])
//     ->name('products.details');

// Route AJAX pour récupérer le modal rempli
Route::get('/products/{product}/modal', [ProductController::class, 'modal'])
    ->name('products.modal');
// BACKEND
// Main Page Route
Route::get('/login', [Login::class, 'index'])->name('dashboard-analytics');
Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');

// locale
//Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
