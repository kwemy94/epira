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
            ['name'=>'Nouvelle hospitalisation','code'=>'hospitalisation'],
            ['name'=>'Nouvelle consultation','code'=>'consultation'],
            ['name'=>'Nouvelle visite','code'=>'visite'],
            ['name'=>'Nouvelle analyse','code'=>'analyse'],
            ['name'=>'Nouvelle imagerie','code'=>'imagerie'],
            ['name'=>'Nouvelle ambulatoire','code'=>'ambulatoire'],
            ['name'=>'Nouvelle pharmacie','code'=>'pharmacie'],
            ['name'=>'Devis','code'=>'Devis']
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
