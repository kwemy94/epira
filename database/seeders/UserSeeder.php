<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'tigod2302@gmail.com',
                'password' => '$2y$12$BIv9P3.R4VARgaYU5N1/2uwei8LqM2zPXBbixEFt4LyaM76gY46pu'
            ],
            [
                'name' => 'CHRE',
                'email' => 'chre@admin.com',
                'password' => '$2y$12$BIv9P3.R4VARgaYU5N1/2uwei8LqM2zPXBbixEFt4LyaM76gY46pu'
            ],
            [
                'name' => 'Patient',
                'email' => 'patient@admin.com',
                'password' => '$2y$12$BIv9P3.R4VARgaYU5N1/2uwei8LqM2zPXBbixEFt4LyaM76gY46pu'
            ],
            [
                'name' => 'Médecin',
                'email' => 'medecin@admin.com',
                'password' => '$2y$12$BIv9P3.R4VARgaYU5N1/2uwei8LqM2zPXBbixEFt4LyaM76gY46pu'
            ],
        ];


        foreach ($users as $key => $user) {
            // $exisUser = DB::table('users')->where('email', $user['email'])->first();
            $exisUser = User::where('email', $user['email'])->first();

            if (!$exisUser) {
                DB::table('users')->insert($user);
                $exisUser = User::where('email', $user['email'])->first();

                // $admin->users()->attach($newUser->id);

                // $exisUser = $newUser;
            }

            if ($key == 0) {
                $exisUser->assignRole('super-admin');
            }
            if ($key == 1) {
                $exisUser->assignRole('admin');
            }
            if ($key == 2) {
                $exisUser->assignRole('patient');
            }
            if ($key == 3) {
                $exisUser->assignRole('medecin');
            }
        }

        # Création de la permission si elle n'existe pas
        $permission = Permission::firstOrCreate([
            'name' => 'manage company',
            'group' => 'Management'
        ]);

        # Récupération du rôle super-admin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super-admin',
        ]);

        # Attribution de la permission au rôle super-admin
        if (!$superAdminRole->hasPermissionTo($permission)) {
            $superAdminRole->givePermissionTo($permission);
        }

    }
}
