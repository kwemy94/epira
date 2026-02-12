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
            # Création DB
            Artisan::call('db:create', ['name' => $this->database]);

            # Switch DB
            toggleDatabaseById($company->id);

            # Migration
            Artisan::call('migrate', ['--path' => 'database/migrations/backend_db', '--force' => true]);

            # Seed
            Artisan::call('db:seed', ['--class' => 'SettingSeeder', '--force' => true]);

            # Update status
            toggleDatabase(false);
            $company->update(['status' => 1]);

            # Mail activation
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
