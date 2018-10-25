<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateConstantsAPIRequest;
use App\Http\Requests\API\v1\UpdateConstantsAPIRequest;
use App\Models\v1\Constants;
use App\Repositories\v1\ConstantsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ConstantsController
 * @package App\Http\Controllers\API\v1
 */

class ConstantsAPIController extends AppBaseController
{
    /** @var  ConstantsRepository */
    private $constantsRepository;

    public function __construct(ConstantsRepository $constantsRepo)
    {
        $this->constantsRepository = $constantsRepo;
    }

    /**
     * Display a listing of the Constants.
     * GET|HEAD /constants
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->constantsRepository->pushCriteria(new RequestCriteria($request));
        $this->constantsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $constants = $this->constantsRepository->all();

        return $this->sendResponse($constants->toArray(), 'Constants retrieved successfully');
    }

    /**
     * Store a newly created Constants in storage.
     * POST /constants
     *
     * @param CreateConstantsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConstantsAPIRequest $request)
    {
        $input = $request->all();

        $constants = $this->constantsRepository->create($input);

        return $this->sendResponse($constants->toArray(), 'Constants saved successfully');
    }

    /**
     * Display the specified Constants.
     * GET|HEAD /constants/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Constants $constants */
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            return $this->sendError('Constants not found');
        }

        return $this->sendResponse($constants->toArray(), 'Constants retrieved successfully');
    }

    /**
     * Update the specified Constants in storage.
     * PUT/PATCH /constants/{id}
     *
     * @param  int $id
     * @param UpdateConstantsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConstantsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Constants $constants */
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            return $this->sendError('Constants not found');
        }

        $constants = $this->constantsRepository->update($input, $id);

        return $this->sendResponse($constants->toArray(), 'Constants updated successfully');
    }

    /**
     * Remove the specified Constants from storage.
     * DELETE /constants/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Constants $constants */
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            return $this->sendError('Constants not found');
        }

        $constants->delete();

        return $this->sendResponse($id, 'Constants deleted successfully');
    }
}
