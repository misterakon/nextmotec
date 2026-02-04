<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\CustomerType;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy(fn ($c) => strtolower($c->name));
        $customerTypes = CustomerType::all()->keyBy(fn ($t) => strtolower($t->name));

        if ($categories->isEmpty()) {
            $this->command->error('Aucune catégorie trouvée. Lance CategorySeeder d’abord.');
            return;
        }

        if ($customerTypes->isEmpty()) {
            $this->command->error('Aucun type client trouvé. Lance CustomerTypeSeeder d’abord.');
            return;
        }

        $products = [
            [
                'category'      => 'logiciel',
                'customer_type' => 'investisseur',
                'name'          => 'SUIT FONCIER',
                'price'         => 0,
                'short_desc'    => "Solution intégrée pour la gestion foncière professionnelle, de la recherche à l'administratif.",
                'long_desc'     => "SUIT FONCIER est une solution complète destinée aux lotisseurs, aménageurs et géomètres. Il simplifie les processus administratifs, techniques et juridiques. Il aide à la recherche d'opportunités, à la vérification des parcelles par rapport aux servitudes d'urbanisme, à l'évaluation des coûts et au suivi des dossiers.",
                'image'         => 'products/suit-foncier.jpg',
                'active'        => true,
            ],
            [
                'category'      => 'formation',
                'customer_type' => 'promoteur',
                'name'          => 'Masterclass Promotion Immobilière',
                'price'         => 100000,
                'short_desc'    => "Formation avancée sur la gestion et l'optimisation des projets de promotion.",
                'long_desc'     => "Cette masterclass est une immersion complète dans le monde de la promotion immobilière. Elle couvre l'ensemble des étapes, de la conception à la vente, en passant par le financement et la gestion des risques.",
                'image'         => 'products/masterclass-promotion.jpg',
                'active'        => true,
            ],
            [
                'category'      => 'template',
                'customer_type' => 'commercial',
                'name'          => 'Accompagnement Achat & Vente',
                'price'         => 150000,
                'short_desc'    => "Conseils experts pour l'achat et la vente de biens immobiliers.",
                'long_desc'     => "Que vous soyez un acheteur à la recherche de la meilleure affaire ou un vendeur qui souhaite maximiser son profit, notre équipe d'experts vous accompagne à chaque étape du processus.",
                'image'         => 'products/accompagnement-achat-vente.jpg',
                'active'        => true,
            ],
            [
                'category'      => 'assistance',
                'customer_type' => 'promoteur',
                'name'          => 'Assistance Juridique & Administrative',
                'price'         => 200000,
                'short_desc'    => "Assistance pour l'obtention et la vérification de documents officiels.",
                'long_desc'     => "Ce package vous offre une expertise complète pour sécuriser vos démarches administratives. Nous vous assistons pour tous les documents nécessaires à vos projets, des agréments aux titres de propriété.",
                'image'         => 'products/assistance-juridique-administrative.jpg',
                'active'        => true,
            ],
        ];

        foreach ($products as $data) {
            $category = $categories[strtolower($data['category'])] ?? null;
            $customerType = $customerTypes[strtolower($data['customer_type'])] ?? null;

            if (!$customerType) {
                $this->command->warn("Type client '{$data['customer_type']}' introuvable, produit ignoré.");
                continue;
            }

            if (!$category) {
                $this->command->warn("Catégorie '{$data['category']}' introuvable, produit ignoré.");
                continue;
            }

            Product::updateOrCreate(
                ['name' => $data['name']],
                [
                    'category_id' => $category->id,
                    'customer_type_id' => $customerType->id,
                    'price' => $data['price'],
                    'short_desc' => $data['short_desc'],
                    'long_desc' => $data['long_desc'],
                    'image' => $data['image'],
                    'active' => $data['active'],
                ]
            );
        }

        $this->command->info('Produits insérés avec succès.');
    }
}
