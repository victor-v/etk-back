<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreatePositionsAPIRequest;
use App\Http\Requests\API\v1\UpdatePositionsAPIRequest;
use App\Models\v1\Positions;
use App\Repositories\v1\PositionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PositionsController
 * @package App\Http\Controllers\API\v1
 */

class PositionsAPIController extends AppBaseController
{
    /** @var  PositionsRepository */
    private $positionsRepository;

    public function __construct(PositionsRepository $positionsRepo)
    {
        $this->positionsRepository = $positionsRepo;
    }

    /**
     * Display a listing of the Positions.
     * GET|HEAD /positions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->positionsRepository->pushCriteria(new RequestCriteria($request));
        $this->positionsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $positions = $this->positionsRepository->all();

        return $this->sendResponse($positions->toArray(), 'Positions retrieved successfully');
    }

    /**
     * Store a newly created Positions in storage.
     * POST /positions
     *
     * @param CreatePositionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePositionsAPIRequest $request)
    {
        $input = $request->all();

        $positions = $this->positionsRepository->create($input);

        return $this->sendResponse($positions->toArray(), 'Positions saved successfully');
    }

    /**
     * Display the specified Positions.
     * GET|HEAD /positions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Positions $positions */
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            return $this->sendError('Positions not found');
        }

        return $this->sendResponse($positions->toArray(), 'Positions retrieved successfully');
    }

    /**
     * Update the specified Positions in storage.
     * PUT/PATCH /positions/{id}
     *
     * @param  int $id
     * @param UpdatePositionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePositionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Positions $positions */
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            return $this->sendError('Positions not found');
        }

        $positions = $this->positionsRepository->update($input, $id);

        return $this->sendResponse($positions->toArray(), 'Positions updated successfully');
    }

    /**
     * Remove the specified Positions from storage.
     * DELETE /positions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Positions $positions */
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            return $this->sendError('Positions not found');
        }

        $positions->delete();

        return $this->sendResponse($id, 'Positions deleted successfully');
    }
}
