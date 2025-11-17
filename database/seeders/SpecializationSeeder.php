<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $specializations = [
            ['name' => 'Chirurgie'],
            ['name' => 'Sage-femme'],
            ['name' => 'Ophtalmologie'],
        ];

        foreach ($specializations as $type) {
            Specialization::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
