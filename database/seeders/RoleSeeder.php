<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Permissions
        $permAdmin = Permission::firstOrCreate(['name' => 'Créer un médecin', 'group' => 'Prestations']);
        $permpresta = Permission::firstOrCreate(['name' => 'Supprimer une prestation', 'group' => 'Prestations']);
        $permUser = Permission::firstOrCreate(['name' => 'Modifier un utilisateur', 'group' => 'Users']);

        # Rôles + permissions
        $roles = [
            'super-admin' => [$permAdmin, $permpresta, $permUser],
            'admin' => [$permAdmin, $permpresta],
            'patient' => [$permAdmin],
            'medecin' => [$permpresta],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            # Synchronise proprement les permissions
            $role->syncPermissions($permissions);
        }
    }
}
