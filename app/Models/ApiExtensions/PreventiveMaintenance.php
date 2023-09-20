<?php

namespace App\Models\ApiExtensions;

use App\Models\ApiExtensions\Kernel\ApiExtensionModelTrait;
use App\Models\ApiExtensions\Kernel\MigratableInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventiveMaintenance extends Model
{
    use HasFactory;
    use ApiExtensionModelTrait;

    const PREFIX = 'pm';
}
