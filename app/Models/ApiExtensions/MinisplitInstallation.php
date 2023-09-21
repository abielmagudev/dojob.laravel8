<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\Traits\HasEssentialFeatures;
use App\Models\ApiExtensions\Kernel\Interfaces\Migratable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinisplitInstallation extends Model implements Migratable
{
    use HasFactory;
    use HasEssentialFeatures;

    const PREFIX = 'mi';

    protected $table = 'apix_minisplit_installation';

    public static $all_pieces = [
        'air handler',
        'ductless air handler',
        'condenser',
    ];

    public static function getAllPieces()
    {
        return self::$all_pieces;
    }

    
    // Migratable

    public static function migrations(): array
    {
        return [
            'apix_minisplit_installation' => 'MinisplitInstallation/create_minisplit_installation_table.php'
        ];
    }
}
