<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\pharmacie\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sites = [
            ['name' => 'Site A', 'location' => 'Mololongui'],
            ['name' => 'Site B', 'location' => 'Biyem-Assi'],
        ];

        foreach ($sites as $site) {
            Warehouse::firstOrCreate(
                ['name' => $site['name'], 'location' => $site['location']],
            );
        }
    }
}
