<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            ['type_name' => 'Tante', 'description' => ''],
            ['type_name' => 'Oncle', 'description' => ''],
            ['type_name' => 'Parent', 'description' => ''],
        ];

        foreach ($contacts as $cat) {
            ContactType::firstOrCreate(
                ['type_name' => $cat['type_name']],
                ['description' => $cat['description']]
            );
        }
    }
}
