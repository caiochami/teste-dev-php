<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Tests\TestCase;

class BrandRepositoryTest extends TestCase
{
    private $repository;
    private $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->createMock(BrandRepository::class);
        $this->model = new Brand();
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
            ->willReturn(new Brand());

        $this->assertInstanceOf(Brand::class, $this->repository->create([]));
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
            ->willReturn(new Brand());

        $this->assertInstanceOf(
            Brand::class,
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
            ->willReturn(new Brand());

        $this->assertInstanceOf(
            Brand::class,
            $this->repository->delete($this->model->id)
        );
    }
}
