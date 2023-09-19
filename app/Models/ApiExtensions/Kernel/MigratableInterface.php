<?php

namespace App\Models\ApiExtensions\Kernel;

interface MigratableInterface
{
    /**
     * return [
     *    // Base table to migrate (key: string)
     *    'table_name' => 'migration_path',
     * 
     *    // Tables related to the base table (key: string)
     *    'table_name_n' => 'migration_n_path',
     * 
     *    // Modify or update the structure of a table (key: integer)
     *    'migration_alter_path',
     * ];
     */
    public static function migrations(): array;

    public static function install();

    public static function uninstall();

    public static function installed();
}
