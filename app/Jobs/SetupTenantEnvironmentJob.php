<?php

namespace App\Jobs;

use App\Mail\CompanyActivationMail;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SetupTenantEnvironmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $companyId,
        public string $database,
        public string $token
    ) {
    }

    public function handle(): void
    {
        $company = Company::findOrFail($this->companyId);

        try {
            // 1️⃣ Création DB
            Artisan::call('db:create', ['name' => $this->database]);

            // 2️⃣ Switch DB
            toggleDatabaseById($company->id);

            // 3️⃣ Migration
            Artisan::call('migrate', ['--path' => 'database/migrations/backend_db', '--force' => true]);

            // 4️⃣ Seed
            Artisan::call('db:seed', ['--class' => 'SettingSeeder', '--force' => true]);

            // 5️⃣ Update status
            toggleDatabase(false);
            $company->update(['status' => 1]);

            // 6️⃣ Mail activation
            Mail::to($company->email)
                ->queue(new CompanyActivationMail(
                    $this->token,
                    $company
                ));

        } catch (Throwable $e) {
            Log::error("Tenant setup failed", $e, $e->getMessage());
            throw $e;
        }
    }
}
