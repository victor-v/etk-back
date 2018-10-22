<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateErrorsAPIRequest;
use App\Http\Requests\API\v1\UpdateErrorsAPIRequest;
use App\Models\v1\Errors;
use App\Repositories\v1\ErrorsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ErrorsController
 * @package App\Http\Controllers\API\v1
 */

class ErrorsAPIController extends AppBaseController
{
    /** @var  ErrorsRepository */
    private $errorsRepository;

    public function __construct(ErrorsRepository $errorsRepo)
    {
        $this->errorsRepository = $errorsRepo;
    }

    /**
     * Display a listing of the Errors.
     * GET|HEAD /errors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $errors = $this->errorsRepository->all();

        return $this->sendResponse($errors->toArray(), 'Errors retrieved successfully');
    }

    /**
     * Store a newly created Errors in storage.
     * POST /errors
     *
     * @param CreateErrorsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateErrorsAPIRequest $request)
    {
        $input = $request->all();

        $errors = $this->errorsRepository->create($input);

        return $this->sendResponse($errors->toArray(), 'Errors saved successfully');
    }

    /**
     * Display the specified Errors.
     * GET|HEAD /errors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Errors $errors */
        $errors = $this->errorsRepository->findWithoutFail($id);

        if (empty($errors)) {
            return $this->sendError('Errors not found');
        }

        return $this->sendResponse($errors->toArray(), 'Errors retrieved successfully');
    }

    /**
     * Update the specified Errors in storage.
     * PUT/PATCH /errors/{id}
     *
     * @param  int $id
     * @param UpdateErrorsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateErrorsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Errors $errors */
        $errors = $this->errorsRepository->findWithoutFail($id);

        if (empty($errors)) {
            return $this->sendError('Errors not found');
        }

        $errors = $this->errorsRepository->update($input, $id);

        return $this->sendResponse($errors->toArray(), 'Errors updated successfully');
    }

    /**
     * Remove the specified Errors from storage.
     * DELETE /errors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Errors $errors */
        $errors = $this->errorsRepository->findWithoutFail($id);

        if (empty($errors)) {
            return $this->sendError('Errors not found');
        }

        $errors->delete();

        return $this->sendResponse($id, 'Errors deleted successfully');
    }
}
