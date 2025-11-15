<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pharmacie\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodTypes = [
            ['name' => 'PHARMACEUTIQUE'],
            ['name' => 'AUTRE'],
        ];

        foreach ($prodTypes as $type) {
            ProductType::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
