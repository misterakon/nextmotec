<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;
use App\Models\Product;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Exemple : on cible le produit "Assistance Juridique & Administrative"
        $product = Product::where('name', 'LIKE', '%Assistance%')->first();

        if (!$product) {
            $this->command->error('Produit cible introuvable pour FeatureSeeder.');
            return;
        }

        $features = [
            "Recherche d'opportunités foncières",
            "Vérification des parcelles",
            "Évaluation des coûts de projet",
            "Suivi administratif des dossiers",
            "Support technique 24/7 et mises à jour",
        ];

        foreach ($features as $index => $title) {
            Feature::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'title' => $title,
                ],
                [
                    'description' => null,
                    'sort_order'  => $index + 1,
                    'active'      => true,
                ]
            );
        }

        $this->command->info('Fonctionnalités ajoutées avec succès.');
    }
}
