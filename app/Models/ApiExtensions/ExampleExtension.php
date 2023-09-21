<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\Traits\HasEssentialFeatures;
use App\Models\ApiExtensions\Kernel\Interfaces\Migratable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleExtension extends Model implements Migratable
{
    use HasFactory;
    use HasEssentialFeatures;

    const PREFIX = 'ex';

    protected $table = 'apix_example_extension';

    
    // Migratable

    public static function migrations(): array
    {
        return [
            'apix_example_extension' => 'example-extension/create_apix_example_extension_table.php',
        ];
    }
}
