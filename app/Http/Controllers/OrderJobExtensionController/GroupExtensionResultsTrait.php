<?php

namespace App\Http\Controllers\OrderJobExtensionController;

use Illuminate\Database\Eloquent\Collection;

trait GroupExtensionResultsTrait
{
    public function groupByResult(Collection $extensions, string $status)
    {
        return $extensions->groupBy(function ($extension) use ($status) {
            return $extension->result[$status] ? 'success' : 'failed';
        });
    }
}
