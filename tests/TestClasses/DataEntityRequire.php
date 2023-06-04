<?php

namespace Sinemah\DataEntities\Tests;

use Sinemah\DataEntities\Data;
use Sinemah\DataEntities\Entity\Requireable;

class DataEntityRequire extends Data
{
    use Requireable;

    protected array $requireable = [
        'is_active',
        'created_at',
        'message',
    ];

    public int $created_at;
    public bool $is_active;
    public string $message;
}