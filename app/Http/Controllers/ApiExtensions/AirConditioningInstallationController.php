<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AirConditioningInstallationController extends Controller
{
    public function create()
    {
        return view('api-extensions/air-conditioning-installation/create');
    }
}
