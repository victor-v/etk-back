<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateStructuresAPIRequest;
use App\Http\Requests\API\v1\UpdateStructuresAPIRequest;
use App\Models\v1\Structures;
use App\Repositories\v1\StructuresRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StructuresController
 * @package App\Http\Controllers\API\v1
 */

class StructuresAPIController extends AppBaseController
{
    /** @var  StructuresRepository */
    private $structuresRepository;

    public function __construct(StructuresRepository $structuresRepo)
    {
        $this->structuresRepository = $structuresRepo;
    }

    /**
     * Display a listing of the Structures.
     * GET|HEAD /structures
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $structures = $this->structuresRepository->all();

        return $this->sendResponse($structures->toArray(), 'Structures retrieved successfully');
    }

    /**
     * Store a newly created Structures in storage.
     * POST /structures
     *
     * @param CreateStructuresAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStructuresAPIRequest $request)
    {
        $input = $request->all();

        $structures = $this->structuresRepository->create($input);

        return $this->sendResponse($structures->toArray(), 'Structures saved successfully');
    }

    /**
     * Display the specified Structures.
     * GET|HEAD /structures/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Structures $structures */
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            return $this->sendError('Structures not found');
        }

        return $this->sendResponse($structures->toArray(), 'Structures retrieved successfully');
    }

    /**
     * Update the specified Structures in storage.
     * PUT/PATCH /structures/{id}
     *
     * @param  int $id
     * @param UpdateStructuresAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStructuresAPIRequest $request)
    {
        $input = $request->all();

        /** @var Structures $structures */
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            return $this->sendError('Structures not found');
        }

        $structures = $this->structuresRepository->update($input, $id);

        return $this->sendResponse($structures->toArray(), 'Structures updated successfully');
    }

    /**
     * Remove the specified Structures from storage.
     * DELETE /structures/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Structures $structures */
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            return $this->sendError('Structures not found');
        }

        $structures->delete();

        return $this->sendResponse($id, 'Structures deleted successfully');
    }
}
