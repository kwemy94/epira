<?php

namespace Database\Seeders;

use App\Models\pharmacie\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'ml'],
            ['name' => 'mg'],
            ['name' => 'g'],
            ['name' => 'L'],
        ];

        foreach ($units as $type) {
            Unit::firstOrCreate(
                ['name' => $type['name']],
            );
        }
    }
}
