<?php

namespace App\Models\ApiExtensions\Kernel;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

trait HasMigrationUpdates
{
    public static function migrations()
    {
        $directory = self::getAbsolutePathExtension() . '/migrations';
        return is_dir($directory) ? File::files($directory) : [];
    }

    public static function install()
    {
        foreach(self::migrations() as $migration)
        {
            Artisan::call('migrate', [
                '--path' => sprintf('%s/migrations/%s', self::getRelativePathExtension(), $migration->getFilename()),
                '--force' => true,
            ], Log::info(
                sprintf('%s %s migrated', self::class,$migration->getFilename())
            ));
        }
    }
}
