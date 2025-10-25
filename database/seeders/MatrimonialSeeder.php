<?php

namespace Database\Seeders;

use App\Models\Matrimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatrimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matrimonials = [
            ['name' => 'Marié', 'description' => ''],
            ['name' => 'Célibataire', 'description' => ''],
            ['name' => 'Divorcé', 'description' => ''],
            ['name' => 'Autre', 'description' => ''],
        ];

        foreach ($matrimonials as $cat) {
            Matrimonial::firstOrCreate(
                ['name' => $cat['name']],
                ['description' => $cat['description']]
            );
        }
    }
}
