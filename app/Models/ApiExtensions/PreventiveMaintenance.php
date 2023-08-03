<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasHelpers;
use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventiveMaintenance extends Model
{
    use HasFactory;
    use HasHelpers;
    use HasMigrationUpdates;

    static $prefix = 'pm';
    
    protected $table = 'api_extension_preventive_maintenance';
}
