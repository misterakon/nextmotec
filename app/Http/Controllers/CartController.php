<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubscriptionType;

class CartController extends Controller
{
    
    public function get()
    {
        $cart = session()->get('cart', []);
        $items = collect($cart)->values();
        $count = $items->sum('qty');
        $total = $items->sum(fn($i) => $i['price'] * $i['qty']);

        return response()->json([
            'items' => $items,
            'count' => $count,
            'total' => $total,
            'total_label' => number_format($total, 0, ',', ' ') . ' FCFA',
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','integer','exists:products,id'],
            'subscription_type_id' => ['nullable','integer','exists:subscription_type,id'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        $offer = null;
        if (!empty($data['subscription_type_id'])) {
            $offer = SubscriptionType::where('id', $data['subscription_type_id'])
                ->where('product_id', $product->id)
                ->firstOrFail();
        }

        $price = $offer ? (float)$offer->price : (float)$product->price;

        $key = $offer ? "p{$product->id}_s{$offer->id}" : "p{$product->id}";
        $cart = session()->get('cart', []);

        if (!isset($cart[$key])) {
            $cart[$key] = [
                'key' => $key,
                'product_id' => $product->id,
                'subscription_type_id' => $offer?->id,
                'name' => $product->name,
                'offer_title' => $offer?->titre,
                'offer_type' => $offer?->type,
                'achat_unique' => (bool)($offer?->achat_unique ?? false),
                'price' => $price,
                'image' => $product->image ? asset('storage/app/public/products/'.$product->image) : asset('frontend/assets/img/course-1.jpg'),
                'qty' => 0,
            ];
        }

        $cart[$key]['qty'] += 1;
        session()->put('cart', $cart);

        return $this->get();
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'key' => ['required','string'],
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$data['key']]);
        session()->put('cart', $cart);

        return $this->get();
    }

}
