<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'manage company', 'group' => 'management', 'guard_name' => 'web'],
            ['name' => 'gestion des utilisateurs', 'group' => 'Users', 'guard_name' => 'web'],
            ['name' => 'créer un utilisateur', 'group' => 'Users', 'guard_name' => 'web'],
            ['name' => 'gestion des patients', 'group' => 'Patients', 'guard_name' => 'web'],
            ['name' => 'peut voir le dossier patient', 'group' => 'Patients', 'guard_name' => 'web'],
            ['name' => 'peut imprimer le dossier patient', 'group' => 'Patients', 'guard_name' => 'web'],
            ['name' => 'peux créer des prestations', 'group' => 'Prestations', 'guard_name' => 'web'],
            ['name' => 'view patient', 'group' => 'Prestations', 'guard_name' => 'web'],
            ['name' => 'create patient', 'group' => 'Prestations', 'guard_name' => 'web'],
            ['name' => 'update patient', 'group' => 'Prestations', 'guard_name' => 'web'],
            ['name' => 'delete user', 'group' => 'Prestations', 'guard_name' => 'web'],
            ['name' => 'create user', 'group' => 'Prestations', 'guard_name' => 'web'],
            ['name' => 'update user', 'group' => 'Prestations', 'guard_name' => 'web'],
        ];
        
    
    foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                ['group' => $permission['group'], 'guard_name' => $permission['guard_name']]
            );
        }
    }
}
