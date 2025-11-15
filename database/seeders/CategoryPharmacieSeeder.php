<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pharmacie\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryPharmacieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'CONSOMMABLE', 'description' => ''],
            ['name' => 'MEDICAMENT', 'description' => ''],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name' => $cat['name']],
                ['description' => $cat['description']]
            );
        }
    }
}
