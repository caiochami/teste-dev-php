<?php

namespace App\Http\Controllers;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarIndexRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Repositories\CarRepository;
use App\Validators\CarValidator;

/**
 * Class CarController.
 *
 * @package namespace App\Http\Controllers;
 */
class CarController extends Controller
{
    /**
     * @var CarRepository
     */
    protected $repository;

    /**
     * @var CarValidator
     */
    protected $validator;

    /**
     * CarController constructor.
     *
     * @param CarRepository $repository
     * @param CarValidator $validator
     */
    public function __construct(CarRepository $repository, CarValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  CarIndexRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(CarIndexRequest $request)
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $cars = $this->repository->list($request->validated());

        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CarCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CarCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $brand = $this->repository->create($request->all());

            $response = [
                'message' => 'Car created.',
                'data'    => $brand->toArray(),
            ];

            return response()->json($response, 201);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = $this->repository->with('brand')->find($id);

        return response()->json([
            'data' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CarUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CarUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $brand = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Car updated.',
                'data'    => $brand->toArray(),
            ];


            return response()->json($response);
        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return response()->json([
            'message' => 'Car deleted.',
            'deleted' => $deleted,
        ]);
    }
}
