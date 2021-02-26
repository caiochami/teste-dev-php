<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BrandRepository;
use App\Models\Brand;
use App\Validators\BrandValidator;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BrandRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BrandRepositoryEloquent extends BaseRepository implements BrandRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Brand::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return BrandValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Display a listing of the resource.
     * 
     * @param array $request
     * 
     * @return LengthAwarePaginator
     */

    public function list(array $filters = []): LengthAwarePaginator
    {
        $collection = $this->query();

        $where = [];

        if (isset($filters['name'])) {
            $where[] = ['name', 'LIKE', '%' . $filters['name'] . '%'];
        }

        return $collection->where($where)->orderBy('updated_at', 'desc')->paginate(5);
    }
}
