<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Cameroun (237)', 'description' => ''],
            ['name' => 'Tchad', 'description' => ''],
            ['name' => 'Congo', 'description' => ''],
        ];

        foreach ($countries as $cat) {
            Country::firstOrCreate(
                ['name' => $cat['name']],
                ['description' => $cat['description']]
            );
        }
    }
}
