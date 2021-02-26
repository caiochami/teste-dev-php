<?php

namespace Tests\Feature;

use App\Models\Brand;
use Tests\TestCase;

class BrandTest extends TestCase
{
    /**
     * @var Brand $record
     */
    private $record;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBrandsCanBeRetrived()
    {
        $response = $this->getJson('api/marcas');

        $response->assertStatus(200);
    }

    public function createPayloadProvider(): array
    {
        return [
            'name_is_invalid' => [
                ['name' => "B"], 422
            ],
            'valid_data' => [
                ['name' => 'Hello World'], 201
            ]
        ];
    }


    /**
     * @dataProvider createPayloadProvider
     */

    public function testABrandCanBeStored(array $payload, int $expectedStatusCode)
    {
        $response = $this->postJson('api/marcas', $payload);
        $response->assertStatus($expectedStatusCode);
    }

    public function testASingleBrandCanBeRetrieved()
    {
        $record = self::createNewRecord();
        $response = $this->getJson('api/marcas/' . $record->id);
        $response->assertStatus(200);
    }

    public function updatePayloadProvider(): array
    {
        return [
            'name_is_invalid' => [
                ['name' => "B"], 422
            ],
            'valid_data' => [
                ['name' => 'Hello World'], 200
            ]
        ];
    }


    /**
     * @dataProvider updatePayloadProvider
     */

    public function testAssertABrandCanBeModified(array $payload, int $expectedStatusCode)
    {
        $record = self::createNewRecord();

        if (is_null($payload['name'])) {
            $payload['name'] = self::createNewRecord()->name;
        }
        $response = $this->putJson('api/marcas/' . $record->id, $payload);
        $response->assertStatus($expectedStatusCode);
    }

    public function testAssertABrandCanBeDestroyed()
    {
        $record = self::createNewRecord();
        $response = $this->getJson('api/marcas/' . $record->id);
        $response->assertStatus(200);
    }


    /**
     * Create a new record
     * 
     * @return Brand
     */

    private static function createNewRecord(): Brand
    {
        return Brand::factory()->create();
    }
}
