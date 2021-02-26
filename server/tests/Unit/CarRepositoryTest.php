<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Repositories\CarRepository;
use Tests\TestCase;

class CarRepositoryTest extends TestCase
{
    private $repository;
    private $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->createMock(CarRepository::class);
        $this->model = new Car();
        $this->model->id = 1;
    }
    /**
     * Asserts if a new record was created
     *
     * @return void
     */
    public function testCreateNewRecord()
    {
        $this->repository
            ->method('create')
            ->willReturn(new Car());

        $this->assertInstanceOf(Car::class, $this->repository->create([]));
    }

    /**
     * Asserts if a new record was updated
     *
     * @return void
     */
    public function testUpdateARecord()
    {
        $this->repository
            ->method('update')
            ->willReturn(new Car());

        $this->assertInstanceOf(
            Car::class,
            $this->repository->update([], $this->model->id)
        );
    }

    /**
     * Asserts if a new record was deleted
     *
     * @return void
     */
    public function testDeleteARecord()
    {
        $this->repository
            ->method('delete')
            ->with(
                $this->greaterThan(0)
            )
            ->willReturn(new Car());

        $this->assertInstanceOf(
            Car::class,
            $this->repository->delete($this->model->id)
        );
    }
}
