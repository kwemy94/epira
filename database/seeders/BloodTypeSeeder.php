<?php

namespace Database\Seeders;

use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodTypes = [
            ['name' => 'O-'],
            ['name' => 'B-'],
            ['name' => 'B+'],
            ['name' => 'AB-'],
            ['name' => 'AB+'],
            ['name' => 'A-'],
            ['name' => 'A+'],
            ['name' => 'O+'],
        ];

        foreach ($bloodTypes as $type) {
            BloodType::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
