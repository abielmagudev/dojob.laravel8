<?php

namespace App\Models\ApiExtensions\Kernel\Interfaces;

/**
 * migrations(): [
 *    // Base table to migrate (key: string)
 *    'table_name' => 'path/migration.php',
 * 
 *    // Tables related to the base table (key: string)
 *    'table_name_n' => 'path/n_migration.php',
 * 
 *    // Modify or update the structure of a table (key: integer)
 *    n => 'path/migration.php',
 * ];
 */
interface Migratable
{
    public static function migrations(): array;
}
