<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['logiciel', 'formation', 'template', 'assistance'];
        foreach ($names as $name) {
            Category::updateOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }   
    }
}