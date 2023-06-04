<?php

namespace Sinemah\DataEntities\Entity;

use Sinemah\DataEntities\Exceptions\MissingRequiredPropertyException;

trait Requireable
{
    /**
     * @throws MissingRequiredPropertyException
     */
    protected function validate(array $data): void
    {
        if(count($this->requires()) === 0) {
            return;
        }

        $diff = array_diff($this->requires(), array_keys($data));

        if(count($diff) > 0) {
            throw new MissingRequiredPropertyException(sprintf('Missing properties: %s', implode(',', $diff)));
        }
    }

    protected function requires(): array
    {
        return $this->requireable ?? [];
    }
}