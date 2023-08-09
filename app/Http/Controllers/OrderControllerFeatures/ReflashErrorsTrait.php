<?php

namespace App\Http\Controllers\OrderControllerFeatures;

/**
 * Reflashes the request validation errors('errors') or error message('danger')
 * saved in session for the extension forms of the selected job of the order
 */
trait ReflashErrorsTrait
{
    private function reflashApiExtensionErrors()
    {
        if( session()->has('errors') || session()->has('danger') )
            session()->reflash();
    }
}
