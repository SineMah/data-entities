<?php declare(strict_types=1);

namespace Sinemah\DataEntities;

use Error;
use PHPUnit\Framework\TestCase;
use Sinemah\DataEntities\Tests\DataEntityIgnore;

class DataEntityIgnoreTest extends TestCase
{
    public function test_load_data_entity_with_constructor_as_ignorable()
    {
        $now = time();
        $data = new DataEntityIgnore(
            [
                'created_at' => $now,
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );
//        $this->assertEquals($now, $data->created_at);
        $this->assertEquals('Lorem Ipsum', $data->message);
        $this->assertFalse($data->is_active);

        $this->assertEquals(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ],
            $data->toArray()
        );
    }

    public function test_load_data_entity_from_array_as_ignorable()
    {
        $now = time();
        $data = new DataEntityIgnore(
            [
                'created_at' => $now,
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );
        $this->assertEquals('Lorem Ipsum', $data->message);
        $this->assertFalse($data->is_active);

        $this->assertEquals(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ],
            $data->toArray()
        );
    }

    public function test_load_data_entity_expect_initialization_error_on_missing_property()
    {
        $now = time();
        $data = new DataEntityIgnore(
            [
                'created_at' => $now,
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );

        $this->expectException(Error::class);
        $this->expectExceptionMessage('Typed property Sinemah\DataEntities\Tests\DataEntityIgnore::$created_at must not be accessed before initialization');

        $this->assertEquals($now, $data->created_at);
    }
}
