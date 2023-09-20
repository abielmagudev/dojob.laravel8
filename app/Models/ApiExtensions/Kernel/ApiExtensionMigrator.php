<?php

namespace App\Models\ApiExtensions\Kernel;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ApiExtensionMigrator
{
    const DATABASE_PATH = '/database/migrations/api-extensions';

    public static function is(string $model)
    {
        return is_a($model, MigratableInterface::class, true);
    }

    public static function install(string $model): bool
    {
        foreach($model::migrations() as $migration)
        {
            Artisan::call('migrate', [
                '--path' => sprintf('%s/%s', self::DATABASE_PATH, $migration), 
                '--force' => true
            ]);
        }

        return self::installed( $model::migrations() );
    }

    public static function uninstall(string $model): bool
    {
        foreach($model::migrations() as $migration)
        {
            Artisan::call('migrate:rollback', [
                '--path' => sprintf('%s/%s', self::DATABASE_PATH, $migration), 
                '--force' => true
            ]);
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
