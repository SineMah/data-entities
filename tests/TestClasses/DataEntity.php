<?php

namespace Sinemah\DataEntities\Tests;

use Sinemah\DataEntities\Data;

class DataEntity extends Data
{
    public int $created_at;
    public bool $is_active;
    public string $message;
}