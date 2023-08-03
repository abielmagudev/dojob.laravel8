<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasHelpers;
use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinisplitInstallation extends Model
{
    use HasFactory;
    use HasHelpers;
    use HasMigrationUpdates;

    static $prefix = 'mi';

    protected $table = 'api_extension_minisplit_installation';

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
