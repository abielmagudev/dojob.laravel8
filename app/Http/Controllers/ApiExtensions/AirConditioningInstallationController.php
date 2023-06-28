<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AirConditioningInstallationController extends Controller
{
    public function create(Request $request)
    {
        return [
            'template' => view('api-extensions/air-conditioning-installation/create')->render(),
        ];
    }
}
