<?php

namespace App\Http\Controllers\ApiExtensions\Kernel;

use Illuminate\Http\Request;
use Illuminate\View\View;

interface ConfigurableInterface
{
    public function settings(Request $request): View;
    
    public function settingsUpdate(Request $request): bool;
}
