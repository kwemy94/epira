<?php

namespace Database\Seeders;

use App\Models\StudyLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'Licence'],
            ['name' => 'Master'],
            ['name' => 'Doctorat'],
        ];

        foreach ($levels as $cat) {
            StudyLevel::firstOrCreate(
                ['name' => $cat['name']],
            );
        }
    }
}
