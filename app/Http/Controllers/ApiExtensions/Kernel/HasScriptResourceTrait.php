<?php

namespace App\Http\Controllers\ApiExtensions\Kernel;

trait HasScriptResourceTrait
{
    public function scriptResource(string $method)
    {
        return isset($this->script_resources, $this->script_resources[$method]) ? $this->script_resources[$method] : null;
    }
}
