<?php declare(strict_types=1);

namespace Sinemah\DataEntities;

use Error;
use PHPUnit\Framework\TestCase;
use Sinemah\DataEntities\Exceptions\MissingRequiredPropertyException;
use Sinemah\DataEntities\Tests\DataEntityEmptyRequire;
use Sinemah\DataEntities\Tests\DataEntityRequire;

class DataEntityRequireTest extends TestCase
{
    public function test_load_data_entity_with_constructor_and_empty_array()
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessage('Missing properties: is_active,created_at,message');

        new DataEntityRequire();
    }

    public function test_load_data_entity_with_constructor()
    {
        $now = time();
        $data = new DataEntityRequire(
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

    public function test_load_data_entity_from_array_as_required()
    {
        $now = time();
        $data = DataEntityRequire::from(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
                'created_at' => $now,
            ]
        );

        $this->assertEquals(false, $data->get('is_active'));
        $this->assertEquals('Lorem Ipsum', $data->get('message'));
        $this->assertEquals($now, $data->get('created_at'));
    }

    public function test_load_data_entity_from_array_as_required_with_missing_property()
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessage('Missing properties: created_at');

        DataEntityRequire::from(
            [
                'message' => 'Lorem Ipsum',
                'is_active' => false,
            ]
        );
    }

    public function test_load_data_entity_from_array_as_required_with_missing_properties()
    {
        $this->expectException(MissingRequiredPropertyException::class);
        $this->expectExceptionMessage('Missing properties: is_active,created_at');

        DataEntityRequire::from(['message' => 'Lorem Ipsum',]);
    }

    public function test_load_data_entity_from_array_with_empty_required_properties()
    {
        $data = DataEntityEmptyRequire::from(['message' => 'Lorem Ipsum',]);

        $this->assertEquals(['message' => 'Lorem Ipsum',], $data->toArray());
    }
}
