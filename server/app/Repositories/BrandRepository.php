<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BrandRepository.
 *
 * @package namespace App\Repositories;
 */
interface BrandRepository extends RepositoryInterface
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
