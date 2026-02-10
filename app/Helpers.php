<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

/**
 * Génère une référence unique au format : PREFIX + année + numéro incrémental
 *
 * Exemple : HOSP2025000001
 *
 * @param string $prefix  (ex: 'PO')
 * @param string $table   Nom de la table concernée
 * @param string $column  Nom de la colonne contenant la référence
 * @return string
 */
if (!function_exists('generateReference')) {
    function generateReference($prefix, $table, $column = 'reference')
    {
        $year = date('Y');

        // On cherche la dernière référence de l'année en cours
        $lastRef = DB::table($table)
            ->where($column, 'like', $prefix . $year . '%')
            ->orderBy($column, 'desc')
            ->value($column);

        // On extrait le dernier numéro pour incrémenter
        if ($lastRef) {
            $lastNumber = (int) substr($lastRef, strlen($prefix . $year));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Formater avec 6 chiffres (000001)
        $formattedNumber = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        return $prefix . $year . $formattedNumber;
    }
}

if (!function_exists('toggleDatabase')) {
    function toggleDatabase($isClientDatabase = true)
    {
        if ($isClientDatabase) {
            // $userRepository = new UserRepository(new User());

            $user = \Auth::user(); //
            // dd('test', $user);
            if ($user):
                // dd(session());
                // dd($user);
                $company = DB::table('companies')->where('id', $user->company_id)->first();
                // dd($company);
                $settings = json_decode($company->settings);


                config()->set('database.connections.mobility', [
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
                    'modes' => [
                        //'ONLY_FULL_GROUP_BY', // Disable this to allow grouping by one column
                        'STRICT_TRANS_TABLES',
                        'NO_ZERO_IN_DATE',
                        'NO_ZERO_DATE',
                        'ERROR_FOR_DIVISION_BY_ZERO',
                        //'NO_AUTO_CREATE_USER', // This has been deprecated and will throw an error in mysql v8
                        'NO_ENGINE_SUBSTITUTION',
                    ],
                ]);
                DB::purge('mobility');
                $connection = DB::connection('mobility');
                Config::set('database.default', $connection->getName());
            else:
                dd('test2');
                $connection = null;
            endif;
        } else {

            $connection = DB::connection('mysql');
            Config::set('database.default', 'mysql');

        }

        return $connection;
    }

}

if (!function_exists('toggleDatabaseById')) {
    function toggleDatabaseById($companyId)
    {
        toggleDatabase(false);
        $ets = DB::table('companies')->where('id', $companyId)->first();

        if ($ets):
            try {
                $settings = json_decode($ets->settings);

                config()->set('database.connections.client_db', [
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
                    'modes' => [
                        //'ONLY_FULL_GROUP_BY', // Disable this to allow grouping by one column
                        'STRICT_TRANS_TABLES',
                        'NO_ZERO_IN_DATE',
                        'NO_ZERO_DATE',
                        'ERROR_FOR_DIVISION_BY_ZERO',
                        //'NO_AUTO_CREATE_USER', // This has been deprecated and will throw an error in mysql v8
                        'NO_ENGINE_SUBSTITUTION',
                    ],
                ]);
                DB::purge('client_db');

                $connection = DB::connection('client_db');
                Config::set('database.default', $connection->getName());
            } catch (\Throwable $th) {
                dd($th);
                //throw $th;
            }
        else:
            $connection = null;

        endif;

        return $connection;
    }

}
if (!function_exists('checkCompany')) {
    function checkCompany()
    {
        toggleDatabase(false);
        $user = \Auth::user();

        if (!$user || !$user->company_id) {
            return null;
        }

        return User::where('company_id', $user->company_id)
            ->role('super-admin') // Spatie
            ->first();
    }
}

if (!function_exists('adminCompany')) {
    function adminCompany()
    {
        toggleDatabase(false);
        $user = Auth::user();
        $company = DB::table('companies')
        ->where('email', $user->email)
        ->first();
        // dd($user->getRoleNames()->first());

        return ($company && $user->getRoleNames()->first() == 'admin') ? true : false;
    }
}


if (!function_exists('generateRandomPassword')) {
    function generateRandomPassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz$@_-%+ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);

        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;

    }
}
