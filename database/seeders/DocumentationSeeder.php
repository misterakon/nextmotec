<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documentation;
use App\Models\Product;


class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::where('name', 'LIKE', '%Assistance%')->first();

        if (!$product) {
            $this->command->error('Produit cible introuvable pour DocumentationSeeder.');
            return;
        }

        $documentations = [
            [
                'title' => "Manuel d'utilisation",
                'type'  => 'pdf',
                'url'   => '/docs/manuel-utilisation.pdf',
            ],
            [
                'title' => "Démonstration vidéo",
                'type'  => 'video',
                'url'   => 'https://www.youtube.com/watch?v=demo',
            ],
            [
                'title' => "Guide de prise en main",
                'type'  => 'markdown',
                'url'   => null,
                'content' => "## Introduction\n\nCe guide explique les premières étapes d'utilisation du service.",
            ],
        ];

        foreach ($documentations as $doc) {
            Documentation::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'title'      => $doc['title'],
                ],
                [
                    'type'    => $doc['type'],
                    'url'     => $doc['url'] ?? null,
                    'content' => $doc['content'] ?? null,
                    'active'  => true,
                ]
            );
        }

        $this->command->info('Documentations insérées avec succès.');
    }
}
