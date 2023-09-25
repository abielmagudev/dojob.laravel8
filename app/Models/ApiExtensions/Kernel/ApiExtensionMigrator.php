<?php

namespace App\Models\ApiExtensions\Kernel;

use App\Models\ApiExtensions\Kernel\Interfaces\Migratable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ApiExtensionMigrator
{
    const DATABASE_PATH = 'database/migrations/api-extensions';

    public static function is(string $model)
    {
        return is_a($model, Migratable::class, true);
    }

    public static function install(string $model): bool
    {
        foreach($model::migrations() as $migration_filename)
        {
            // Artisan::call('migrate', [
            //     '--path' => self::path($migration_filename), 
            //     '--force' => true
            // ]);

            $migration = include_once( self::path($migration_filename) );
            
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
            // Artisan::call('migrate:rollback', [
            //     '--path' => self::path($migration_filename), 
            //     '--force' => true
            // ]);

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

    private static function path($migration_filename)
    {
        return database_path("migrations/api-extensions/{$migration_filename}");
        
        // return sprintf('%s/%s', self::DATABASE_PATH, $migration_filename);
    }
}
