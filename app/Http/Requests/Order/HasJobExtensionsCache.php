<?php

namespace App\Http\Requests\Order;

use Illuminate\Database\Eloquent\Collection;

trait HasJobExtensionsCache
{
    /**
     * Cache job extensions query for next use
     * With this you avoid 2 or more subsequent queries
     */
    public function cacheExtensions(Collection $extensions)
    {
        $this->merge([
            'job_extensions_cache' => $extensions,
        ]);
    }
}
