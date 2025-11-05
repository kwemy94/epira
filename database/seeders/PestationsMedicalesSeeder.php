<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PestationsMedicalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestations = [
            ["name"=>"Consultation Généraliste","code"=>"consultation_généraliste"],
            ["name"=>"Consultation Spécialiste","code"=>"consultation_spécialiste"],
            ["name"=>"Consultation Dentiste","code"=>"consultation_dentiste"]
        ];


        foreach ($prestations as $prestation) {
            DB::table('prestation_medicales')->insert([
                'name' => $prestation['name'],
                'code' => $prestation['code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
