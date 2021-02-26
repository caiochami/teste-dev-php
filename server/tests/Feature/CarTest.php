<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * @var Car $record
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
    public function testCarsCanBeRetrived()
    {
        $response = $this->getJson('api/carros');

        $response->assertStatus(200);
    }


    public function testACarCanBeStored()
    {
        $record = self::createNewRecord();
        $response = $this->postJson('api/carros', [
            'model' => 'testing',
            'year' => 1972,
            'brand_id' => $record->brand_id

        ]);

        $response->assertStatus(201);
    }

    public function testASingleCarCanBeRetrieved()
    {
        $record = self::createNewRecord();
        $response = $this->getJson('api/carros/' . $record->id);
        $response->assertStatus(200);
    }

    public function testAssertACarCanBeModified()
    {
        $record = self::createNewRecord();
        $response = $this->putJson('api/carros/' . $record->id, [
            'model' => $record->model,
            'year' => $record->year,
            'brand_id' => $record->brand_id

        ]);

        $response->assertStatus(200);
    }

    public function testAssertACarCanBeDestroyed()
    {
        $record = self::createNewRecord();
        $response = $this->getJson('api/carros/' . $record->id);
        $response->assertStatus(200);
    }


    /**
     * Create a new record
     * 
     * @return Car
     */

    private static function createNewRecord(): Car
    {
        return Car::factory()->create();
    }
}
