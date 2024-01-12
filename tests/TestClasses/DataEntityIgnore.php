<?php

namespace Sinemah\DataEntities\Tests;

use Sinemah\DataEntities\Data;
use Sinemah\DataEntities\Entity\Ignoreable;
use Sinemah\DataEntities\Entity\Requireable;

class DataEntityIgnore extends Data
{
    use Ignoreable;

    protected array $ignoreable = [
        'created_at',
    ];

    public int $created_at;
    public bool $is_active;
    public string $message;
}
