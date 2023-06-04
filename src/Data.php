<?php

namespace Sinemah\DataEntities;

use ReflectionClass;
use ReflectionProperty;

class Data
{
    public static function from(array $data = []): static
    {
        $instance = new static();

        $instance->load($data);

        return $instance;
    }

    public function toArray(): array
    {
        $reflectionClass = new ReflectionClass($this);
        $publicAttributes = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);

        $data = [];

        foreach ($publicAttributes as $attribute) {
            $attributeName = $attribute->getName();

            if(isset($this->{$attributeName})) {
                $data[$attributeName] = $attribute->getValue($this);
            }
        }

        return $data;
    }

    protected function validate(array $data): void
    {}

    protected function load(array $data): void
    {
        $this->validate($data);

        foreach($data as $key => $value) {

            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}