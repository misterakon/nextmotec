<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\dashboard\Crm;
use App\Http\Controllers\CartController;
use App\Http\Controllers\frontend\PaiementController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



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
    Route::delete('/produit/{id}', [AdminController::class, 'delete_produit'])->name('prod.delete_produit');

    //Route::get('/produit/{id}', [AdminController::class, 'get_produit'])->name('prod.get_produit');

    Route::get('/temoignage', [AdminController::class, 'temoignage'])->name('prod.temoignage');
    Route::post('/temoignage', [AdminController::class, 'save_temoignage'])->name('prod.save_temoignage');
    Route::get('/temoignage/{id}', [AdminController::class, 'get_temoignage'])->name('prod.get_temoignage');
    Route::delete('/temoignage/{id}', [AdminController::class, 'delete_temoignage'])->name('prod.delete_temoignage');
});

Route::get('/produit/{id}', [AdminController::class, 'get_produit'])->name('prod.get_produit');

// Pour la gestion du panier
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'get'])->name('cart.get');

Route::get('/panier', [CartController::class, 'panier'])->name('panier'); 
Route::post('/cart/update', [CartController::class,'update'])->name('cart.update');

Route::get('/checkout', [CartController::class, 'commande'])->name('checkout.commande'); 
Route::post('/passer_commande', [CartController::class, 'passer_commande'])->name('passer_commande'); 
Route::get('/connexion', [CartController::class, 'connexion'])->name('connexion'); 
Route::post('/connexion', [CartController::class, 'form_connexion'])->name('connexion'); 
Route::get('/inscription', [CartController::class, 'inscription'])->name('inscription'); 
Route::post('/inscription', [CartController::class, 'form_inscription'])->name('inscription'); 
Route::get('/deconnexion', [CartController::class, 'deconnexion'])->name('deconnexion'); 
Route::get('/profil', [CartController::class, 'profil'])->name('profil'); 
Route::post('/profil', [CartController::class, 'update_profil'])->name('profil'); 

Route::post('/paiement', [PaiementController::class, 'paiement'])->name('paiement'); 
Route::post('/paiement/notify', [PaiementController::class, 'notify_payment'])->name('notify'); 
Route::post('/paiement/check/{id}', [PaiementController::class, 'check_payment'])->name('check'); 

// Route::get('/checkout_refresh/{id}', [CartController::class, 'get_panier_refresh'])->name('checkout.refresh'); 
// Route::post('/checkout', [CartController::class, 'add'])->name('checkout.add_panier'); 
// Route::delete('/checkout/{id}', [CartController::class, 'delete'])->name('checkout.delete_panier'); 

require __DIR__.'/auth.php';
