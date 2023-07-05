<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\HasGetters;
use App\Models\ApiExtensions\Kernel\HasMigrationUpdates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventiveMaintenance extends Model
{
    use HasFactory;
    use HasGetters;
    use HasMigrationUpdates;

    const PREFIX = 'pm';
    
    protected $table = 'api_extension_preventive_maintenance';
}
