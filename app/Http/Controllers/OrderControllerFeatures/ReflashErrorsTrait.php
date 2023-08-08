<?php

namespace App\Http\Controllers\OrderControllerFeatures;

trait ReflashErrorsTrait
{
    private function reflashApiExtensionErrors()
    {
        if( session()->has('errors') )
            session()->reflash();
    }
}
