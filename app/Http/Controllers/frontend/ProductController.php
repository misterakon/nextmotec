<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CustomerType;
use App\Models\Category;
use App\Models\Temoignage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'customerType', 'subscriptionTypes')
            ->where('active', '1')
            ->orderBy('created_at', 'desc')
            ->get();

    //    Catégories + produits actifs + relations utiles
        $categories = Category::with([
            'products' => function ($q) {
                $q->where('active', true)
                    ->with(['customerType', 'subscriptionTypes']) 
                    ->orderBy('created_at');
            }])
            ->orderBy('name')
            ->get();

              // Charger les temoignages 
        $temoignages = Temoignage::where('active', '1')
            ->orderBy('created_at', 'desc')
            ->get();


        $customertypes = CustomerType::orderBy('name')->get();
        return view('frontend.index', compact('products', 'customertypes', 'categories','temoignages'));
    }

    // public function details(Product $product)
    // {
    //     $product->load(['features', 'documentations', 'category']);

    //     return response()->json([
    //         'id' => $product->id,
    //         'name' => $product->name,
    //         'short_desc' => $product->short_desc,
    //         'long_desc' => $product->long_desc,
    //         'price' => $product->price,
    //         'features' => $product->features,
    //         'docs' => $product->documentations,
    //     ]);
    // }

    public function modal(Product $product)
    {
        $product->load(['category', 'features', 'documentations']);

        return view('frontend.modal_description', compact('product'));
        }


     /**
     * Détail d’un produit
     */
    
}
