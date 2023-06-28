<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use App\Models\ApiExtensions\Kernel\HasPropertyGetters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinisplitInstallation extends Model
{
    use HasFactory;
    use HasMigrationUpdates;
    use HasPropertyGetters;

    protected $table = 'api_extension_minisplit_installation';

    public $prefix = 'mi';

    public $name = 'Minisplit Installation';
    
    public $description = 'Minisplit installation description.';

    public static $all_pieces = [
        'air handler',
        'ductless air handler',
        'condenser',
    ];

    public static function getAllPieces()
    {
        return self::$all_pieces;
    }
}
