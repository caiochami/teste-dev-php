<?php

namespace App\Http\Controllers;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BrandCreateRequest;
use App\Http\Requests\BrandIndexRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Repositories\BrandRepository;
use App\Validators\BrandValidator;

/**
 * Class BrandController.
 *
 * @package namespace App\Http\Controllers;
 */
class BrandController extends Controller
{
    /**
     * @var BrandRepository
     */
    protected $repository;

    /**
     * @var BrandValidator
     */
    protected $validator;

    /**
     * BrandController constructor.
     *
     * @param BrandRepository $repository
     * @param BrandValidator $validator
     */
    public function __construct(BrandRepository $repository, BrandValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  BrandIndexRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(BrandIndexRequest $request)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $brands = $this->repository->list($request->validated());

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BrandCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BrandCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $brand = $this->repository->create($request->validated());

            $response = [
                'message' => 'Brand created.',
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
        $brand = $this->repository->with('cars')->find($id);

        return response()->json([
            'data' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BrandUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BrandUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $brand = $this->repository->update($request->validated(), $id);

            $response = [
                'message' => 'Brand updated.',
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
            'message' => 'Brand deleted.',
            'deleted' => $deleted,
        ]);
    }
}
