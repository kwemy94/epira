<?php

namespace App\Console\Commands;

use App\Repositories\CompanyRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use App\Repositories\Etablissement\EtablissementRepository;

class DBMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:backend_db {path} {--artisanPath= : The absolute path to project root folder} {--targetDomain= : The specific domain to handle} {--rollback : Rollback migrations instead of running them} {--step=1 : Number of migrations to rollback}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command de migration/rollback de la base de données backend (path: chemin relatif vers le repertoire des migrations backend)';

    protected $companyRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        parent::__construct();
        $this->companyRepository = $companyRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $path = $this->arguments('path');
            $companies = $this->companyRepository->getAll(); # établissements actifs

            foreach ($companies as $company) {
                # Switch to current company database
                $settings = json_decode($company->settings);

                $database = $settings->db->database;

                config()->set('database.connections.migration', [
                    'driver' => 'mysql',
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => $settings->db->database,
                    'username' => $settings->db->username,
                    'password' => $settings->db->password,
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'strict' => true,
                    'engine' => null,
                ]);

                DB::purge('migration');

                $connection = DB::connection('migration');

                Config::set('database.default', $connection->getName());

                $this->info($connection->getName());
                // dd($path);
                // dd($path['path']);

                if ($this->option('rollback')) {
                    Artisan::call('migrate:rollback', [
                        '--path' => '/database/migrations/' . $path['path'],
                        '--force' => true,
                        '--step' => $this->option('step')
                    ]);
                    $this->info("Rollback complet !");
                } else {
                    Artisan::call('migrate', [
                        '--path' => '/database/migrations/' . $path['path'],
                        '--force' => true
                    ]);
                    $this->info("Migration complet !");
                }

                $data = Artisan::output();

                $this->info("Database: ${database}");

                $this->info($data);

                $this->info($this->option('rollback')? "Rollback complet" : "Migation complet !");
            }

        } catch (\Throwable $th) {
            dd($th);
            $this->info("Error migration");
        }
        return 0;
    }
}
