# Data Entities
A small lib to transfer from one application Layer to another.   
Valinor and Laravel-Data ain't focussing on a DTO core principle. Data Entities has some convenient methods included.

## Installation
```bash
composer require sinema/data-entities
```

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

## To Array
```php
$message->toArray();
```

## Get Single Values
Also works neither attributes are not initialized nor exists.
```php
$message->get('user');
```