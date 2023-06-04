## Attributes

### Basic Attributes
```php
use Sinemah\DataEntities\Data;

class Message extends Data
{
    public string $text;
    public string $user;
    public int $created_at;
}
```

### Required Attributes
```php
use Sinemah\DataEntities\Data;
use Sinemah\DataEntities\Entity\Requireable;

class Message extends Data
{
    use Requireable;

    protected array $requireable = [
        'text',
        'user',
        'created_at',
    ];

    public string $text;
    public string $user;
    public int $created_at;
}
```

## Load from Array
```php
$message = Message::from(['user' => 'John Smith', 'text' => 'Lorem Ipsum']);
```