<?php

namespace Sinemah\DataEntities\Entity;

use Sinemah\DataEntities\Exceptions\MissingRequiredPropertyException;

trait Ignoreable
{
    protected function ignores(): array
    {
        return $this->ignoreable ?? [];
    }
}
