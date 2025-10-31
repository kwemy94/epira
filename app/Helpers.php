<?php

use Illuminate\Support\Facades\DB;

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
