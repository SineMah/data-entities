<?php

namespace Sinemah\DataEntities\Tests;

use Sinemah\DataEntities\Data;
use Sinemah\DataEntities\Entity\Requireable;

class DataEntityEmptyRequire extends Data
{
    use Requireable;

    public int $created_at;
    public bool $is_active;
    public string $message;
}