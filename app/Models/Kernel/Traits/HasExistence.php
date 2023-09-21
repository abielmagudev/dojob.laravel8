<?php

namespace App\Models\Kernel\Traits;

trait HasExistence
{
    public function isReal(): bool
    {
        return isset( $this->id );
    }

    public function isFake(): bool
    {
        return ! $this->isReal();
    }

    public function isSet(string $attribute): bool
    {
        return isset( $this->$attribute );
    }

    public function isNull(string $attribute): bool
    {
        return is_null( $this->$attribute );
    }

    public function isEmpty(string $attribute): bool
    {
        return empty( $this->$attribute );
    }
}
