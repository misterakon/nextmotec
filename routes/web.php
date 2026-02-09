<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\frontend\ProductController;



Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [ProductController::class, 'index'])
    ->name('products.index');

// Route AJAX pour récupérer le modal rempli
Route::get('/products/{product}/modal', [ProductController::class, 'modal'])
    ->name('products.modal');

    ///////////////////////////////////
////////////// BACKEND ///////////////////////

// Route::get('/dashboard', function () {
//  return view('backend.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/type_client', [AdminController::class, 'type_client'])->name('parametre.type_client');
    Route::post('/type_client', [AdminController::class, 'save_type_client'])->name('parametre.save_type');
    Route::get('/type_client/{id}', [AdminController::class, 'get_type'])->name('parametre.get_type');
    Route::delete('/type_client/{id}', [AdminController::class, 'delete_type'])->name('parametre.delete_type');

    Route::get('/categorie', [AdminController::class, 'categorie'])->name('parametre.categorie');
    Route::post('/categorie', [AdminController::class, 'save_categorie'])->name('parametre.save_categorie');
    Route::get('/categorie/{id}', [AdminController::class, 'get_categorie'])->name('parametre.get_categorie');
    Route::delete('/categorie/{id}', [AdminController::class, 'delete_categorie'])->name('parametre.delete_categorie');

    Route::get('/produit', [AdminController::class, 'produit'])->name('prod.produit');
    Route::post('/produit', [AdminController::class, 'save_produit'])->name('prod.save_produit');
    //Route::get('/produit/{id}', [AdminController::class, 'get_produit'])->name('prod.get_produit');
    Route::delete('/produit/{id}', [AdminController::class, 'delete_produit'])->name('prod.delete_produit');


    Route::get('/temoignage', [AdminController::class, 'temoignage'])->name('prod.temoignage');
    Route::post('/temoignage', [AdminController::class, 'save_temoignage'])->name('prod.save_temoignage');
});

Route::get('/produit/{id}', [AdminController::class, 'get_produit'])->name('prod.get_produit');

require __DIR__.'/auth.php';
