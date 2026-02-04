<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\SubscriptionType;

class SubscriptionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all()->keyBy('name');

        if ($products->isEmpty()) {
            $this->command->error("Aucun produit trouvé. Lance ProductSeeder d'abord.");
            return;
        }

        /**
         * IMPORTANT
         * type ENUM('ANNUEL','MENSUEL')
         */
        $offersByProductName = [
            'SUIT FONCIER' => [
                [
                    'type' => 'MENSUEL',
                    'titre' => 'Abonnement mensuel',
                    'price' => 25000,
                    'description' => "- Jusqu'à 10 biens\n- Support technique",
                    'achat_unique' => false,
                ],
                [
                    'type' => 'ANNUEL',
                    'titre' => 'Abonnement annuel (15% de réduction)',
                    'price' => 255000,
                    'description' => "- Jusqu'à 10 biens\n- Support technique",
                    'achat_unique' => false,
                ],
            ],
            'Accompagnement Achat & Vente' => [
                [
                    'type' => 'ANNUEL', // obligatoire car ENUM, mais achat_unique override l'affichage
                    'titre' => 'Achat unique',
                    'price' => 150000,
                    'description' => "- Analyse du besoin\n- Conseils personnalisés\n- Suivi complet",
                    'achat_unique' => true,
                ],
            ],
        ];

        $count = 0;

        foreach ($offersByProductName as $productName => $offers) {
            $product = $products[$productName] ?? null;

            if (!$product) {
                $this->command->warn("Produit '$productName' introuvable, ignoré.");
                continue;
            }

            foreach ($offers as $offer) {
                SubscriptionType::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'type' => $offer['type'], // ✅ ENUM STRICT
                    ],
                    [
                        'titre' => $offer['titre'],
                        'price' => $offer['price'],
                        'description' => $offer['description'],
                        'achat_unique' => $offer['achat_unique'],

                    ]
                );

                $count++;
            }
        }

        $this->command->info("SubscriptionTypes insérés/mis à jour : {$count}");
    }
}
