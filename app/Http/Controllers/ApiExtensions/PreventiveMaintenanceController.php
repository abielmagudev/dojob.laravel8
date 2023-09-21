<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use App\Models\ApiExtensions\PreventiveMaintenance;
use Illuminate\Http\Request;

class PreventiveMaintenanceController extends Controller
{
    public function create()
    {
        return view('api-extensions/preventive-maintenance/create', [
            'class' => PreventiveMaintenance::class,
        ]);
    }
}
