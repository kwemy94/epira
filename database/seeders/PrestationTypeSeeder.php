<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PrestationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        PrestationType::insert([
            ['name'=>'Nouvelle hospitalisation','code'=>'newh'],
            ['name'=>'Nouvelle consulatation','code'=>'newc'],
            ['name'=>'Nouvelle visite','code'=>'newv'],
            ['name'=>'Nouvelle analyse','code'=>'newa'],
            ['name'=>'Nouvelle imagerie','code'=>'newi'],
            ['name'=>'Nouvelle ambulatoire','code'=>'newam'],
            ['name'=>'Nouvelle pharmacie','code'=>'newp'],
            ['name'=>'Nouvelle hospitalisation','code'=>'newh'],
            ['name'=>'Devis','code'=>'devis']
        ]);
    }
}
