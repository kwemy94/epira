<?php

namespace Database\Seeders;

use App\Models\StaffType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $staffTypes = [
            ['name' => 'Medécin'],
            ['name' => 'Infirmier'],
            ['name' => 'Pharmacien'],
            ['name' => 'Technicien'],
        ];

        foreach ($staffTypes as $type) {
            StaffType::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
