<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pharmacie\StockType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StockTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stockTypes = [
            ['name' => 'Boîte (B)'],
            ['name' => 'Unitaire (U)'],
            ['name' => 'Flacon (F)'],
            ['name' => 'Ampoule (A)'],
            ['name' => 'Sachet (S)'],
        ];

        foreach ($stockTypes as $type) {
            StockType::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
