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
            ['name'=>'Nouvelle hospitalisation','code'=>'newh'],
            ['name'=>'Nouvelle consultation','code'=>'newc'],
            ['name'=>'Nouvelle visite','code'=>'newv'],
            ['name'=>'Nouvelle analyse','code'=>'newa'],
            ['name'=>'Nouvelle imagerie','code'=>'newi'],
            ['name'=>'Nouvelle ambulatoire','code'=>'newam'],
            ['name'=>'Nouvelle pharmacie','code'=>'newp'],
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
