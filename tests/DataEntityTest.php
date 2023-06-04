<?php declare(strict_types=1);

namespace Sinemah\DataEntities;

use Error;
use PHPUnit\Framework\TestCase;
use Sinemah\DataEntities\Tests\DataEntity;

class DataEntityTest extends TestCase
{
    public function test_load_empty_data_entity()
    {
        $this->assertInstanceOf(Data::class, new DataEntity());
    }

    public function test_load_array_from_empty_data_entity()
    {
        $data = DataEntity::from();
        $this->assertEquals([], $data->toArray());
        $this->assertEmpty($data->toArray());
    }

    public function test_load_data_entity_from_array()
    {
        $now = time();
        $data = DataEntity::from(
            [
                'created_at' => $now,
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );
        $this->assertEquals($now, $data->created_at);
        $this->assertEquals('Lorem Ipsum', $data->message);
        $this->assertEquals(false, $data->is_active);

        $this->assertEquals(
            [
                'created_at' => $now,
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ],
            $data->toArray()
        );
    }

    public function test_load_data_entity_from_array_with_not_defined_property()
    {
        $data = DataEntity::from(
            [
                'additional' => 1,
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );

        $this->assertEquals('Lorem Ipsum', $data->message);
        $this->assertEquals(false, $data->is_active);

        $this->assertEquals(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ],
            $data->toArray()
        );

        $this->assertNull($data->get('additional'));
    }

    public function test_load_data_entity_from_array_with_missing_attribute()
    {
        $data = DataEntity::from(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );

        $this->assertEquals(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ],
            $data->toArray()
        );

        $this->expectException(Error::class);
        $this->expectExceptionMessage('Typed property Sinemah\DataEntities\Tests\DataEntity::$created_at must not be accessed before initialization');

        $this->assertEquals(7, $data->created_at);
    }

    public function test_get_existing_value_from_data_entity_key()
    {
        $data = DataEntity::from(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );

        $this->assertEquals(false, $data->get('is_active'));
        $this->assertEquals('Lorem Ipsum', $data->get('message'));
    }

    public function test_get_missing_value_from_data_entity_key()
    {
        $data = DataEntity::from(['message' => 'Lorem Ipsum',]);

        $this->assertNull($data->get('is_active'));
    }

    public function test_get_default_for_missing_value_from_data_entity_key()
    {
        $data = DataEntity::from(['message' => 'Lorem Ipsum',]);

        $this->assertEquals(false, $data->get('is_active', false));
    }
}
