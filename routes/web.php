<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\Crm;
use App\Http\Controllers\backend\dashboard\Analytics;
use App\Http\Controllers\backend\language\LanguageController;

Route::get('/', function () {
    return view('frontend.index');
});


// BACKEND
// Main Page Route
// Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');

// locale
//Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
