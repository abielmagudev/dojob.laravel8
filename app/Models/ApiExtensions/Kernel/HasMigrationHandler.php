<?php

namespace App\Models\ApiExtensions\Kernel;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

trait HasMigrationHandler
{
    public static $database_path = '/database/migrations/api-extensions';
    
    public static function install()
    {
        foreach(self::migrations() as $migration)
        {
            Artisan::call('migrate', [
                '--path' => sprintf('%s/%s', self::$database_path, $migration), 
                '--force' => true
            ]);
        }

        return self::installed();
    }

    public static function uninstall()
    {
        foreach(self::migrations() as $table => $migration)
        {
            if( is_string($table) )
            {
                Artisan::call('migrate:rollback', [
                    '--path' => sprintf('%s/%s', self::$database_path, $migration), 
                    '--force' => true
                ]);
            }
        }

        return self::uninstalled();
    }

    public static function installed()
    {
        $tables = array_keys( self::migrations() );

        $failed = array_filter($tables, function ($table) {
            return is_string($table) &&! self::hasTable($table);
        });

        return empty($failed);
    }

    public static function uninstalled()
    {
        return ! self::installed();
    }

    public static function hasTable(string $table)
    {
        return Schema::hasTable($table);
    }

    public static function hasNotTable(string $table)
    {
        return ! self::hasTable($table);
    }
}
