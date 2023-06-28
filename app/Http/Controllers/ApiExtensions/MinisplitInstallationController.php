<?php

namespace App\Http\Controllers\ApiExtensions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MinisplitInstallationController extends Controller
{
    public function create(Request $request)
    {
        return [
            'template' => view('api-extensions/minisplit-installation/create')->render(),
            'script' => null,
        ];
    }
}
