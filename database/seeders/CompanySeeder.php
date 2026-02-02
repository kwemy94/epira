<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Company A',
                'address' => '123 Main St, Cityville',
                'email' => 'admin@admin.com',
                'status' => 2,
                'settings' => json_encode(array("db" => array('database' => 'epira', 'username' => 'root', 'password' => ''), 'momo' => '{}')),
            ],
            [
                'name' => 'Company B',
                'address' => '456 Oak Ave, Townsburg',
                'email' => 'companyb@example.com',
                'status' => 1,
                'settings' => json_encode(array("db" => array('database' => 'epira_test', 'username' => 'root', 'password' => ''), 'momo' => '{}')),
            ],
        ];

        foreach ($companies as $company) {
            $existingCompany = Company::where('email', $company['email'])->first();
            if (!$existingCompany) {
                Company::create($company);
            }
        }
    }
}
