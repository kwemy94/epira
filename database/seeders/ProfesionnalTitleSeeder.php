<?php

namespace Database\Seeders;

use App\Models\ProfesionnalTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfesionnalTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $titles = [
            ['name' => 'Dr'],
            ['name' => 'Pr'],
        ];

        foreach ($titles as $type) {
            ProfesionnalTitle::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
