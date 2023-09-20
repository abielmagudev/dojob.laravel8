<?php

namespace App\Models\ApiExtensions\Kernel;

/**
 * migrations(): [
 *    // Base table to migrate (key: string)
 *    'table_name' => 'migration_path',
 * 
 *    // Tables related to the base table (key: string)
 *    'table_name_n' => 'migration_n_path',
 * 
 *    // Modify or update the structure of a table (key: integer)
 *    n => 'migration_path',
 * ];
 */
interface MigratableInterface
{
    public static function migrations(): array;
}
