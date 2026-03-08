<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Customer;
use App\Models\Panier;
use App\Models\Product;
use App\Models\SubscriptionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CartController extends Controller
{    
    public function get_old()
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

    public function get()
    {
        if(Auth::guard('customer')->check()){

            $customerId = Auth::guard('customer')->id();

            $items = Panier::where('customer_id',$customerId)
                ->where('statut','panier')
                ->get()
                ->map(function($item){

                    return [
                        'key' => $item->id,
                        'product_id' => $item->product_id,
                        'name' => $item->product->name,
                        'price' => $item->prix_unitaire,
                        'qty' => $item->quantite,
                        'image' => $item->product->image
                            ? asset('storage/app/public/'.$item->product->image)
                            : asset('public/frontend/assets/img/course-1.jpg')
                    ];

                });

        }else{

            $cart = session()->get('cart', []);
            $items = collect($cart)->values();

        }

        $count = $items->sum('qty');
        $total = $items->sum(fn($i) => $i['price'] * $i['qty']);

        return response()->json([
            'items' => $items,
            'count' => $count,
            'total' => $total,
            'total_label' => number_format($total,0,',',' ') . ' FCFA'
        ]);
    }

    public function add_old(Request $request)
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
                'image' => $product->image ? asset('storage/app/public/'.$product->image) : asset('public/frontend/assets/img/course-1.jpg'),
                'qty' => 0,
            ];
        }

        $cart[$key]['qty'] += 1;
        session()->put('cart', $cart);

        return $this->get();
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required','integer','exists:products,id'],
            'subscription_type_id' => ['nullable','integer','exists:subscription_type,id'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        $offer = null;

        if(!empty($data['subscription_type_id'])){
            $offer = SubscriptionType::where('id', $data['subscription_type_id'])
                ->where('product_id',$product->id)
                ->firstOrFail();
        }

        $price = $offer ? $offer->price : $product->price;

        //CLIENT CONNECTÉ
        if(Auth::guard('customer')->check()){

            $customerId = Auth::guard('customer')->id();

            $panier = Panier::where('customer_id',$customerId)
                ->where('product_id',$product->id)
                ->where('statut','panier')
                ->first();

            if($panier){

                $panier->quantite += 1;
                $panier->save();

            }else{

                Panier::create([
                    'customer_id' => $customerId,
                    'product_id' => $product->id,
                    'quantite' => 1,
                    'prix_unitaire' => $price ?? 0,
                    'statut' => 'panier'
                ]);

            }

        }
        else{

            $key = $offer ? "p{$product->id}_s{$offer->id}" : "p{$product->id}";

            $cart = session()->get('cart', []);

            if(!isset($cart[$key])){
                $cart[$key] = [
                    'key'=>$key,
                    'product_id'=>$product->id,
                    'subscription_type_id'=>$offer?->id,
                    'name'=>$product->name,
                    'offer_title' => $offer?->titre,
                    'offer_type' => $offer?->type,
                    'achat_unique' => (bool)($offer?->achat_unique ?? false),
                    'price' => $price,
                    'image' => $product->image ? asset('storage/app/public/'.$product->image) : asset('public/frontend/assets/img/course-1.jpg'),
                    'qty' => 0,
                ];
            }

            $cart[$key]['qty'] += 1;

            session()->put('cart',$cart);

        }

        return $this->get();
    }

    public function remove(Request $request)
    {
        $key = $request->key;

        if(Auth::guard('customer')->check()){

            Panier::where('id',$key)->delete();

        }else{

            $cart = session()->get('cart',[]);
            unset($cart[$key]);
            session()->put('cart',$cart);

        }

        return $this->get();
    }

    public function remove_old(Request $request)
    {
        $data = $request->validate([
            'key' => ['required','string'],
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$data['key']]);
        session()->put('cart', $cart);

        return $this->get();
    }

    public function update(Request $request)
    {
        $key = $request->key;
        $change = $request->change;

        if(Auth::guard('customer')->check()){

            $panier = Panier::find($key);

            if($panier){

                $panier->quantite += $change;

                if($panier->quantite <= 0){
                    $panier->delete();
                }else{
                    $panier->save();
                }

            }

        }else{

            $cart = session()->get('cart',[]);

            if(isset($cart[$key])){

                $cart[$key]['qty'] += $change;

                if($cart[$key]['qty'] <= 0){
                    unset($cart[$key]);
                }

            }

            session()->put('cart',$cart);

        }

        return $this->get();
    }

    public function update_old(Request $request)
    {
        $cart = session()->get('cart', []);

        $key = $request->key;
        $change = $request->change;

        if(isset($cart[$key])){

            $cart[$key]['qty'] += $change;

            if($cart[$key]['qty'] <= 0){
                unset($cart[$key]);
            }

        }

        session()->put('cart',$cart);

        return $this->get();
    }

    public function passer_commande()
    {
        //On vérifie si le client est connecté
        if(!Auth::guard('customer')->check()){
            return redirect()->route('connexion')
                            ->with('error','Veuillez vous connecter pour continuer');
        }

        $customerId = Auth::guard('customer')->id();

        //Recuperation des données du panier
        $paniers = Panier::where('customer_id',$customerId)
                        ->where('statut','panier')
                        ->get();

        if($paniers->isEmpty()){
            return back()->with('error','Votre panier est vide');
        }

        //On calcule le montant total de la commande du customer
        $montantTotal = $paniers->sum(function($p){
            return $p->quantite * $p->prix_unitaire;
        });

        //Generation du code commande
        $prefix = strtoupper(substr(Str::random(3), 0, 3));
        $date = date('Ymd');

        $lastCommande = Commande::whereDate('created_at',today())->count() + 1;

        $code = $prefix.'.'.$date.'.'.str_pad($lastCommande,4,'0',STR_PAD_LEFT);

        DB::beginTransaction();

        try{

            //Création de la commande
            $commande = Commande::create([
                'code' => $code,
                'customer_id' => $customerId,
                'montant_total' => $montantTotal,
                'code_transaction' => $this->generateTransactionCode(),
                'statut' => 'en_attente',
                'date_commande' => now()
            ]);

            //Mise à jour du panier
            Panier::where('customer_id',$customerId)
                ->where('statut','panier')
                ->update([
                    'statut' => 'commande',
                    'commande_id' => $commande->id,
                ]);

            DB::commit();

        }catch(\Exception $e){

            DB::rollback();
            return back()->with('error','Erreur lors de la création de la commande');

        }

        // //redirection vers le paiement
        return response()->view('frontend.layout.redirect_paiement', [
            'url' => route('paiement'),
            'data' => [
                'id' => $commande->id,
                'url_back' => route('checkout.commande'),
            ]
        ]);

    }

    private function generateTransactionCode()
    {
        //la derniere commande
        $last = Commande::orderBy('id','desc')->first();

        if($last && $last->code_transaction){

            //on extrait Pxxx
            preg_match('/P(\d+)/', $last->code_transaction, $matches);

            $num = isset($matches[1]) ? intval($matches[1]) + 1 : 1;

        }else{
            $num = 1;
        }

        // format P001
        $p = 'P'.str_pad($num,3,'0',STR_PAD_LEFT);

        $datetime = Carbon::now()->format('YmdHisv');

        //NT.20260307154523123.P002
        return "NT.$datetime.$p";
    }

    /* CONNEXION CLIENT et PANIER */
    public function commande ()
    {
        //On vérifie si le client est connecté
        if(!Auth::guard('customer')->check()){
            return redirect()->route('connexion')
                            ->with('error','Veuillez vous connecter pour continuer');
        }

        $customerId = Auth::guard('customer')->id();

        $commandes = Commande::where('customer_id', $customerId)
                            ->orderBy('date_commande','desc')->get();

        $nb_commande = Commande::where('customer_id', $customerId)
                                ->where('statut', "en_attente")->get()->count();

        $menu = "commande";

        return view('frontend.commande', compact('menu', 'commandes', 'nb_commande'));
    }

    public function profil ()
    {
        //On vérifie si le client est connecté
        if(!Auth::guard('customer')->check()){
            return redirect()->route('connexion')
                            ->with('error','Veuillez vous connecter pour continuer');
        }
        
        $customerId = Auth::guard('customer')->id();

        $profil = Customer::find($customerId);

        $nb_commande = Commande::where('customer_id', $customerId)
                                ->where('statut', "en_attente")->get()->count();

        $menu = "profil";

        return view('frontend.profil', compact('menu', 'nb_commande', 'profil'));
    }

    public function connexion ()
    {
        return view('frontend.login');
    }

    public function inscription ()
    {
        return view('frontend.inscription');
    }

    public function form_connexion(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(Auth::guard('customer')->attempt($credentials)){

            $request->session()->regenerate();

            //fusion panier session + panier client connecté
            $this->mergeCart();

            return redirect()->route('checkout.commande');
        }

        return back()->withInput()->with('error','Email ou mot de passe incorrect');
    }

    //fusion du panier visiteur + client connecté
    public function mergeCart()
    {
        $sessionCart = session('cart', []);

        if(empty($sessionCart)){
            return;
        }

        $customerId = Auth::guard('customer')->id();

        foreach ($sessionCart as $item) {

            $panier = Panier::where('customer_id', $customerId)
                ->where('product_id', $item['product_id'])
                ->where('statut', 'panier')
                ->first();

            if ($panier) {

                $panier->quantite += $item['qty'];
                $panier->save();

            } else {

                Panier::create([
                    'customer_id' => $customerId,
                    'product_id' => $item['product_id'],
                    'quantite' => $item['qty'],
                    'prix_unitaire' => $item['price'] ?? 0,
                    'statut' => 'panier',
                ]);
            }
        }

        session()->forget('cart');
    }

    public function form_inscription(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ],[
            'name.required' => 'Le nom est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas'
        ]);

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        // connexion automatique après inscription
        Auth::guard('customer')->login($customer);

        return redirect()->route('checkout.commande');
    }

    public function update_profil(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'required|string|max:20',
            'adresse' => 'required|string|max:250',
        ],[
            'name.required' => 'Le nom est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé',
            'phone.required' => 'Le téléphone est obligatoire',
            'adresse.required' => 'L’adresse est obligatoire',
        ]);

        $customer->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'adresse' => $data['adresse'],
        ]);

        return back()->with('success', "Profil mis à jour avec succès !");
    }

    public function deconnexion ()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('products.index');
    }

    public function panier ()
    {
        $customerId = Auth::guard('customer')->id();

        $nb_commande = Commande::where('customer_id', $customerId)
                                ->where('statut', "en_attente")->get()->count();

        $menu = "panier";

        return view('frontend.panier', compact('menu', 'nb_commande'));
    }
    /* FIN CONNEXION-PANIER */
    

}
