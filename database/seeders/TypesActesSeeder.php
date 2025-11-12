<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesActesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type_actes = [
            ["name" => "Accouchement normal", "code" => "accouchement_normal", "tarif" => 150000],
            ["name" => "Accouchement par césarienne", "code" => "accouchement_cesarienne", "tarif" => 300000],
            ["name" => "Suivi de grossesse", "code" => "suivi_grossesse", "tarif" => 50000],
            ["name" => "Echographie", "code" => "echographie", "tarif" => 40000],
            ["name" => "Consultation prénatale", "code" => "consultation_prenatale", "tarif" => 30000]
        ];


        foreach ($type_actes as $type_acte) {
            $existing = DB::table('actes')->where('code', $type_acte['code'])->first();
            if ($existing) {
                continue; // Skip insertion if the record already exists
                DB::table('actes')->insert([
                    'name' => $type_acte['name'],
                    'code' => $type_acte['code'],
                    'tarif' => $type_acte['tarif'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}