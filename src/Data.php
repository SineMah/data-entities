<?php

namespace Sinemah\DataEntities;

use ReflectionClass;
use ReflectionProperty;

abstract class Data
{
    public function __construct(array $data = [])
    {
        $this->load($data);
    }

    public static function from(array $data = []): static
    {
        return new static($data);
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

    public function get(string $key, $default = null): mixed
    {
        if(isset($this->{$key})) {
            return $this->{$key};
        }

        return $default;
    }

    protected function validate(array $data): void
    {}

    protected function ignores(): array
    {
        return [];
    }

    protected function load(array $data): void
    {
        $this->validate($data);

        foreach($data as $key => $value) {

            if(in_array($key, $this->ignores())) {
                continue;
            }

            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
