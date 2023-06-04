<?php declare(strict_types=1);

namespace Sinemah\DataEntities;

use Error;
use PHPUnit\Framework\TestCase;
use Sinemah\DataEntities\Exceptions\MissingRequiredPropertyException;
use Sinemah\DataEntities\Tests\DataEntityRequire;

class DataEntityRequireTest extends TestCase
{
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
}