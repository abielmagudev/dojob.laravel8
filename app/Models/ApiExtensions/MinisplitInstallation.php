<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasGetters;
use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinisplitInstallation extends Model
{
    use HasFactory;
    use HasGetters;
    use HasMigrationUpdates;

    const PREFIX = 'mi';

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
