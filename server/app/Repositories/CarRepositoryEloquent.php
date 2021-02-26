<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CarRepository;
use App\Models\Car;
use App\Validators\CarValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class CarRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CarRepositoryEloquent extends BaseRepository implements CarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Car::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CarValidator::class;
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

        if (isset($filters['model'])) {
            $where[] = ['model', 'LIKE', '%' . $filters['model'] . '%'];
        }

        if (isset($filters['year'])) {
            $where[] = ['year', $filters['year']];
        }

        if (isset($filters['brand_name'])) {
            $collection = $collection->whereHas('brand', function (Builder $q) use ($filters) {
                $q->where('name', 'LIKE', '%' . $filters['brand_name'] . '%');
            });
        }

        return $collection->where($where)->orderBy('updated_at', 'desc')->paginate(15);
    }
}
