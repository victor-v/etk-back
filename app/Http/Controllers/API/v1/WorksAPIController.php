<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateWorksAPIRequest;
use App\Http\Requests\API\v1\UpdateWorksAPIRequest;
use App\Models\v1\Works;
use App\Repositories\v1\WorksRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class WorksAPIController
 * @package App\Http\Controllers\API\v1
 */
class WorksAPIController extends AppAPIBaseController
{
    /** @var  WorksRepository */
    private $WorksRepository;

    public function __construct(WorksRepository $WorksRepo)
    {
        $this->WorksRepository = $WorksRepo;
    }

    /**
     * Display a listing of the Works.
     * GET|HEAD /Works
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->page) {
            $page = $request->page;
        } else {
            $page = 1;
        }
        if ($request->tin) {

            $works = json_decode(DB::select('SELECT public."OrgWorkers"(\'628261\', \'2018-10-18\', 1)')[0]->OrgWorkers);

        } else {

            $works = json_decode(DB::select('SELECT public."PersonWorks"(\'' . auth()->user()->user_pin_user . '\',\'' . $page . '\')')[0]->PersonWorks);

        }
        return $this->sendResponse($works, 'Works retrieved successfully');

    }

    /**
     * Store a newly created Works in storage.
     * POST /Works
     *
     * @param CreateWorksAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateWorksAPIRequest $request)
    {
        $input = $request->all();


        $Works = $this->WorksRepository->create($input);

        return $this->sendResponse($Works->toArray(), 'Works saved successfully');
    }

    /**
     * Display the specified Works.
     * GET|HEAD /works/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var works $Works */
        $Works = $this->WorksRepository->findWithoutFail($id);

        if (empty($Works)) {
            return $this->sendError('Works not found');
        }

        return $this->sendResponse($Works->toArray(), 'Works retrieved successfully');
    }

    /**
     * Update the specified Works in storage.
     * PUT/PATCH /works/{id}
     *
     * @param  int $id
     * @param UpdateWorksAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorksAPIRequest $request)
    {
        $input = $request->all();

        /** @var Works $Works */
        $Works = $this->WorksRepository->findWithoutFail($id);

        if (empty($Works)) {
            return $this->sendError('Works not found');
        }

        $Works = $this->WorksRepository->update($input, $id);

        return $this->sendResponse($Works->toArray(), 'Works updated successfully');
    }

    /**
     * Remove the specified Works from storage.
     * DELETE /works/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var works $Works */
        $Works = $this->WorksRepository->findWithoutFail($id);

        if (empty($Works)) {
            return $this->sendError('Works not found');
        }

        $Works->delete();

        return $this->sendResponse($id, 'Works deleted successfully');
    }
}
