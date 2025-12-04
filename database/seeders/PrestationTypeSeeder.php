<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrestationType;


class PrestationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $prestationTypes = [
            ['name'=>'Nouvelle hospitalisation','code'=>'Hospitalisation'],
            ['name'=>'Nouvelle consultation','code'=>'Consultation'],
            ['name'=>'Nouvelle visite','code'=>'Visite'],
            ['name'=>'Nouvelle analyse','code'=>'Analyse'],
            ['name'=>'Nouvelle imagerie','code'=>'Imagerie'],
            ['name'=>'Nouvelle ambulatoire','code'=>'Ambulatoire'],
            ['name'=>'Nouvelle pharmacie','code'=>'Pharmacie'],
            ['name'=>'Devis','code'=>'devis']
        ];
        foreach ($prestationTypes as $type) {
            $pres = PrestationType::where('name', $type['name'])->first();
            if(!$pres){
                 PrestationType::create([
                'name' => $type['name'],
                'code' => $type['code'],
            ]); 

            }
           
        }
    }
}
