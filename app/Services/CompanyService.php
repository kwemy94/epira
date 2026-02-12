<?php

namespace App\Services;

use App\Jobs\SetupTenantEnvironmentJob;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function createCompany(Request $request): Company
    {
        return DB::transaction(function () use ($request) {

            // 1️⃣ Upload logo
            $logo = null;
            if ($request->hasFile('logo')) {
                $logo = Str::uuid() . '.' . $request->logo->extension();
                Storage::disk('public')->putFileAs('company/logo', $request->logo, $logo);
            }

            // 2️⃣ Génération DB tenant
            $database = 'chre_' . Str::slug($request->name, '_') . '_' . time();

            // 3️⃣ Settings JSON
            $settings = [
                'db' => [
                    'database' => $database,
                    'username' => env('TENANT_DB_USER', 'root'),
                    'password' => env('TENANT_DB_PASSWORD', ''),
                ],
                'momo' => [],
            ];

            // 4️⃣ Création companie
            $company = Company::create([
                ...$request->except('logo'),
                'logo' => $logo,
                'status' => 2, // DB non créée
                'settings' => json_encode($settings),
            ]);

            // 5️⃣ Création admin
            $token = Str::random(64);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(32)),
                'activation_token' => $token,
                'company_id' => $company->id,
            ]);
            $user->assignRole('admin');
            
            // 6️⃣ Job asynchrone
            SetupTenantEnvironmentJob::dispatch(
                $company->id,
                $database,
                $token
            );

            return $company;
        });
    }
}
