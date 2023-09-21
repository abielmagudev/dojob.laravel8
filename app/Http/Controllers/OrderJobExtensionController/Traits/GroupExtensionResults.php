<?php

namespace App\Http\Controllers\OrderJobExtensionController\Traits;

use Illuminate\Database\Eloquent\Collection;

trait GroupExtensionResults
{
    public function groupByResult(Collection $extensions, string $status)
    {
        return $extensions->groupBy(function ($extension) use ($status) {
            return $extension->result[$status] ? 'success' : 'failed';
        });
    }
}
