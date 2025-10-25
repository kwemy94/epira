<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['name' => 'CNI'],
            ['name' => 'Passeport'],
            ['name' => 'Permis de conduire'],
        ];

        foreach ($documents as $cat) {
            DocumentType::firstOrCreate(
                ['name' => $cat['name']]
            );
        }
    }
}
