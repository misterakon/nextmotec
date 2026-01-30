<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
use App\Models\CustomerType;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['promoteur', 'gestionnaire', 'commercial', 'investisseur'];
        foreach ($names as $name) {
            CustomerType::updateOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }   
    }
}
