<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CarRepository.
 *
 * @package namespace App\Repositories;
 */
interface CarRepository extends RepositoryInterface
{
    /**
     * Display a listing of the resource.
     * 
     * @param array $request
     * 
     * @return LengthAwarePaginator
     */

    public function list(array $filters = []): LengthAwarePaginator;
}
