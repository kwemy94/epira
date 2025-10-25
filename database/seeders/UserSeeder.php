<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'email' => 'admin@admin.com',
                'password' => '$2y$12$BIv9P3.R4VARgaYU5N1/2uwei8LqM2zPXBbixEFt4LyaM76gY46pu'
            ],
        ];

        foreach ($users as $cat) {
            User::firstOrCreate(
                ['email' => $cat['email']],
                [
                    'name' => $cat['name'],
                    'password' => $cat['password'],
                ]
            );
        }
    }
}
