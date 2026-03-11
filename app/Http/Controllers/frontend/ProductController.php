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
    // public function index()
    // {
    //     $products = Product::with('category', 'customerType', 'subscriptionTypes')
    //         ->where('active', '1')
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     //    Catégories + produits actifs + relations utiles
    //     $categories = Category::with([
    //         'products' => function ($q) {
    //             $q->where('active', true)
    //                 ->with(['customerType', 'subscriptionTypes']) 
    //                 ->orderBy('created_at');
    //         }])
    //         ->orderBy('name')
    //         ->get();

    //           // Charger les temoignages 
    //     $temoignages = Temoignage::where('active', '1')
    //         ->orderBy('created_at', 'desc')
    //         ->get();


    //     $customertypes = CustomerType::orderBy('name')->get();
    //     return view('frontend.index', compact('products', 'customertypes', 'categories','temoignages'));
    // }
    public function index()
    {
        $products = Product::with(['category', 'customerTypes', 'subscriptionTypes'])
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = Category::with([
            'products' => function ($q) {
                $q->where('active', true)
                ->with(['customerTypes', 'subscriptionTypes'])
                ->orderBy('created_at');
            }
        ])
        ->orderBy('name')
        ->get();

        $temoignages = Temoignage::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $customertypes = CustomerType::orderBy('name')->get();

        $guideData = [];

        foreach ($products as $product) {
            $categoryName = strtolower(trim($product->category->name ?? ''));

            if (in_array($categoryName, ['logiciel', 'logiciels'])) {
                $categoryKey = 'logiciel';
            } elseif ($categoryName === 'formations & documentation') {
                $categoryKey = 'formation';
            } elseif ($categoryName === 'services & templates') {
                $categoryKey = 'services';
            } else {
                continue;
            }

            foreach ($product->customerTypes as $customerType) {
                $customerSlug = $customerType->slug;

                if (!isset($guideData[$customerSlug])) {
                    $guideData[$customerSlug] = [
                        'logiciel' => [],
                        'formation' => [],
                        'services' => [],
                    ];
                }

                $guideData[$customerSlug][$categoryKey][] = [
                    'id' => $product->id,
                    'title' => $product->name,
                    'description' => $product->short_desc ?: $product->long_desc ?: 'Aucune description disponible.',
                    'presentation' => $product->long_desc ?: 'Aucune présentation disponible.',
                    'bullets' => $product->features->pluck('title')->take(4)->values()->toArray(),
                ];
            }
        }
        return view('frontend.index', compact(
            'products',
            'customertypes',
            'categories',
            'temoignages',
            'guideData'
        ));
    }

   
    public function modal(Product $product)
    {
        $product->load(['category', 'features', 'documentations']);

        return view('frontend.modal_description', compact('product'));
    }


     /**
     * Détail d’un produit
     */
    
}
