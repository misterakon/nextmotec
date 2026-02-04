<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Models\CustomerType;
use App\Models\Feature;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminController;

class AdminController extends Controller
{
    public function type_client()
    {
        $type_client = CustomerType::all();

        return view('backend.liste_type_client', compact('type_client'));
    }

    public function categorie()
    {
        $categorie = Category::all();

        return view('backend.liste_categorie', compact('categorie'));
    }

    public function produit()
    {
        $type_client = CustomerType::all();
        $categorie = Category::all();
        $produit = Product::with(['customerType', 'category'])->get();

        return view('backend.liste_produit', compact('produit', 'type_client', 'categorie'));
    }

    public function save_type_client(Request $request)
    {
        $id = $request->input('id_'); // null si création

        // Validation unique dynamique
        $request->validate([
            'libelle' => [
                'required',
                Rule::unique('customer_types', 'name')->ignore($id),
            ],
        ], [
            'libelle.unique'    => 'Ce type client existe déjà.',
        ]);

        // Création ou mise à jour
        CustomerType::updateOrCreate(
            ['id' => $id],
            [
                'name'      => $request->libelle,
                'slug' => Str::slug($request->libelle),
            ]
        );

        return redirect()->back()->with(
            'success',
            $id ? 'Type client mis à jour avec succès !' : 'Type client créé avec succès !'
        );
    }

    public function save_categorie(Request $request)
    {
        $id = $request->input('id_'); // null si création

        // Validation unique dynamique
        $request->validate([
            'libelle' => [
                'required',
                Rule::unique('customer_types', 'name')->ignore($id),
            ],
        ], [
            'libelle.unique'    => 'Ce type client existe déjà.',
        ]);

        // Création ou mise à jour
        Category::updateOrCreate(
            ['id' => $id],
            [
                'name'      => $request->libelle,
                'slug' => Str::slug($request->libelle),
            ]
        );

        return redirect()->back()->with(
            'success',
            $id ? 'Catégorie mis à jour avec succès !' : 'Catégorie créée avec succès !'
        );
    }

    public function save_produit(Request $request)
    {
        $id = $request->input('id_');

        $request->validate([
            'libelle' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('customer_type_id', $request->type_client)
                            ->where('category_id', $request->categorie);
                    })
                    ->ignore($id),
            ],
            'type_client' => 'required|exists:customer_types,id',
            'categorie'   => 'required|exists:categories,id',
            'prix'           => 'required|numeric|min:0',
            'short_desc'     => 'required|string|max:255',
            'presentation'   => 'required|string',
            'statut'         => 'required|boolean',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'fonctionnalite' => 'required|array|min:1',
            'fonctionnalite.*' => 'required|string|max:255',
            'type_doc'       => 'nullable|array',
            'fichier'        => 'nullable|array',
            'lien_video'     => 'nullable|array',
        ], [
            'libelle.unique' => 'Ce produit existe déjà pour ce type client et cette catégorie.',
        ]);

        /* Upload de l'image du produit */
        $imagePath = null;

        //Cas de UPDATE : récupérer l’image existante
        if ($request->filled('id_')) {
            $existingProduit = Product::find($request->id_);
            $imagePath = $existingProduit?->image;
        }

        if ($request->hasFile('image')) {
            //(optionnel) on supprime l’ancienne image
            if (!empty($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('produits', 'public');
        }

        /* Création / Mise à jour produit */
        $produit = Product::updateOrCreate(
            ['id' => $id],
            [
                'name'            => $request->libelle,
                'customer_type_id'  => $request->type_client,
                'category_id'    => $request->categorie,
                'price'            => $request->prix,
                'short_desc'      => $request->short_desc,
                'long_desc'    => $request->presentation,
                'active'          => $request->statut,
                'image'           => $imagePath,
            ]
        );

        /* Fonctionnalités */
        //On supprime ici les fonctionnalités du produit en mode mise à jour
        $produit->features()->delete();

        if ($request->fonctionnalite) {
            foreach ($request->fonctionnalite as $index => $titre) {
                $produit->features()->create([
                    'title' => $titre,
                    'sort_order' => $index+1,
                    'active' => true,
                ]);
            }
        }

        /* Documents */
        if ($request->filled('type_doc')) {

            //IDs envoyés par le formulaire
            $sentIds = collect($request->doc_id)->filter();

            // On supprime les documents ou liens retirés du formulaire
            $produit->documentations()
                ->whereNotIn('id', $sentIds)
                ->get()
                ->each(function ($doc) {
                    if ($doc->type === 'pdf') {
                        Storage::disk('public')->delete($doc->url);
                    }
                    $doc->delete();
                });

            foreach ($request->type_doc as $index => $type) {

                $docId = $request->doc_id[$index] ?? null;
                $titre = $request->titre_doc[$index] ?? null;

                /* ===== PDF ===== */
                if ($type === 'pdf' && $request->hasFile("fichier.$index")) {

                    $path = $request->file("fichier.$index")->store('documents', 'public');

                    $produit->documentations()->updateOrCreate(
                        ['id' => $docId],
                        [
                            'type'   => 'pdf',
                            'url'    => $path,
                            'title'  => $titre,
                            'active' => true,
                        ]
                    );
                }

                /* ===== VIDEO ===== */
                if ($type === 'video' && !empty($request->lien_video[$index])) {

                    $produit->documentations()->updateOrCreate(
                        ['id' => $docId],
                        [
                            'type'   => 'video',
                            'url'    => $request->lien_video[$index],
                            'title'  => $titre,
                            'active' => true,
                        ]
                    );
                }
            }
        }


        return back()->with('success', $id ? 'Produit mis à jour avec succès !' : 'Produit créé avec succès !');
    }

    public function get_type($id)
    {
        $type = CustomerType::where('id', $id)->firstOrFail();

        if ($type) {
            return response()->json($type);
        }
    }

    public function get_categorie($id)
    {
        $categorie = Category::where('id', $id)->firstOrFail();

        if ($categorie) {
            return response()->json($categorie);
        }
    }

    public function get_produit($id)
    {
        $produit = Product::with(['features', 'documentations', 'subscriptionTypes','category'])->findOrFail($id);

        if ($produit) {
            return response()->json($produit);
        }
    }

    public function delete_type($id)
	{		
        $type = CustomerType::find($id);
        if ($type) {
            $type->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false], 404);
	}	

    public function delete_categorie($id)
	{		
        $categorie = Category::find($id);
        if ($categorie) {
            $categorie->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false], 404);
	}	

    public function delete_produit($id)
	{		
        $produit = Product::find($id);
        if ($produit) {
            $produit->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false], 404);
	}	
}
