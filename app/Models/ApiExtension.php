<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class ApiExtension extends Model
{
    use HasFactory;

    // Attributes

    public function getTagsArrayAttribute()
    {
        return str_getcsv($this->tags_csv_format);
    }


    // Scopes

    public function scopeHasTags($query, $tags)
    {
        return $query->where('tags_csv_format', 'like', "%{$tags}%");
    }

    // ONLY FOR FACTORY AND SEEDING

    public static function stockByClasses()
    {
        return [
            [
                'model_class' => \App\Models\ApiExtensions\AirConditioningInstallation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\AirConditioningInstallationController::class,
            ],
            [
                'model_class' => \App\Models\ApiExtensions\AtticInsulationCalculation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\AtticInsulationCalculationController::class,
            ],
            [
                'model_class' => \App\Models\ApiExtensions\BattInsulationCalculation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\BattInsulationCalculationController::class,
            ],
            [
                'model_class' => \App\Models\ApiExtensions\PreventiveMaintenance::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\PreventiveMaintenanceController::class,
            ],
            [
                'model_class' => \App\Models\ApiExtensions\MinisplitInstallation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\MinisplitInstallationController::class,
            ],
            [
                'model_class' => \App\Models\ApiExtensions\WallInsulationCalculation::class,
                'controller_class' => \App\Http\Controllers\ApiExtensions\WallInsulationCalculationController::class,
            ],

            // ...
        ];
    }
}
