<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasMigrationHandlerTrait;
use App\Models\ApiExtensions\Kernel\HasOrderRelationshipTrait;
use App\Models\ApiExtensions\Kernel\HasReflectionHimselfTrait;
use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleExtension extends Model implements MigratableInterface
{
    use HasFactory;
    use HasMigrationHandlerTrait;
    use HasOrderRelationshipTrait;
    use HasReflectionHimselfTrait;

    protected $table = 'apix_example_extension';

    public static function migrations(): array
    {
        return [
            'apix_example_extension' => 'example-extension/create_apix_example_extension_table.php',
        ];
    }
}
