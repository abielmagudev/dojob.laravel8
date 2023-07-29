<?php

namespace App\Models\Kernel;

trait Existential
{
    public function isReal()
    {
        return isset( $this->id );
    }

    public function isFake()
    {
        return ! $this->isReal();
    }

    public function isSet(string $attribute)
    {
        return isset( $this->$attribute );
    }

    public function isNull(string $attribute)
    {
        return is_null( $this->$attribute );
    }
}
