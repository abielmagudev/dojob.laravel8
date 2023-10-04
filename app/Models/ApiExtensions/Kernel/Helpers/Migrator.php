<?php

namespace App\Models\ApiExtensions\Kernel\Helpers;

use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Support\Facades\Schema;

class Migrator
{
    public static function is(string $model)
    {
        return is_a($model, MigratableInterface::class, true);
    }

    private static function path($migration_filename)
    {
        return database_path("migrations/api-extensions/{$migration_filename}.php");
    }

    public static function install(string $model): bool
    {
        foreach($model::migrations() as $migration_filename)
        {
            $migration = include( self::path($migration_filename) );
            
            $migration->up();

            if( method_exists($model, 'afterInstalled') )
                $model::afterInstalled();
        }

        return self::installed( $model::migrations() );
    }

    public static function uninstall(string $model): bool
    {
        foreach($model::migrations() as $migration_filename)
        {
            $migration = include_once( self::path($migration_filename) );

            $migration->down();

            if( method_exists($model, 'afterUninstalled') )
                $model::afterUninstalled();
        }

        return self::uninstalled( $model::migrations() );
    }

    public static function installed(array $migrations): bool
    {
        $installed = array_filter($migrations, function ($table) {
            return !is_numeric($table) && Schema::hasTable($table);
        }, ARRAY_FILTER_USE_KEY);

        return $installed == $migrations;
    }

    public static function uninstalled(array $migrations): bool
    {
        return ! self::installed($migrations);
    }
}
