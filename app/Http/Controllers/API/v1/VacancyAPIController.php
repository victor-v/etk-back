<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateVacancyAPIRequest;
use App\Http\Requests\API\v1\UpdateVacancyAPIRequest;
use App\Models\v1\Vacancy;
use App\Repositories\v1\VacancyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VacancyController
 * @package App\Http\Controllers\API\v1
 */

class VacancyAPIController extends AppBaseController
{
    /** @var  VacancyRepository */
    private $vacancyRepository;

    public function __construct(VacancyRepository $vacancyRepo)
    {
        $this->vacancyRepository = $vacancyRepo;
    }

    /**
     * Display a listing of the Vacancy.
     * GET|HEAD /vacancies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->vacancyRepository->pushCriteria(new RequestCriteria($request));
        $this->vacancyRepository->pushCriteria(new LimitOffsetCriteria($request));
        $vacancies = $this->vacancyRepository->all();

        return $this->sendResponse($vacancies->toArray(), 'Vacancies retrieved successfully');
    }

    /**
     * Store a newly created Vacancy in storage.
     * POST /vacancies
     *
     * @param CreateVacancyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVacancyAPIRequest $request)
    {
        $input = $request->all();

        $vacancies = $this->vacancyRepository->create($input);

        return $this->sendResponse($vacancies->toArray(), 'Vacancy saved successfully');
    }

    /**
     * Display the specified Vacancy.
     * GET|HEAD /vacancies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Vacancy $vacancy */
        $vacancy = $this->vacancyRepository->findWithoutFail($id);

        if (empty($vacancy)) {
            return $this->sendError('Vacancy not found');
        }

        return $this->sendResponse($vacancy->toArray(), 'Vacancy retrieved successfully');
    }

    /**
     * Update the specified Vacancy in storage.
     * PUT/PATCH /vacancies/{id}
     *
     * @param  int $id
     * @param UpdateVacancyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVacancyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Vacancy $vacancy */
        $vacancy = $this->vacancyRepository->findWithoutFail($id);

        if (empty($vacancy)) {
            return $this->sendError('Vacancy not found');
        }

        $vacancy = $this->vacancyRepository->update($input, $id);

        return $this->sendResponse($vacancy->toArray(), 'Vacancy updated successfully');
    }

    /**
     * Remove the specified Vacancy from storage.
     * DELETE /vacancies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Vacancy $vacancy */
        $vacancy = $this->vacancyRepository->findWithoutFail($id);

        if (empty($vacancy)) {
            return $this->sendError('Vacancy not found');
        }

        $vacancy->delete();

        return $this->sendResponse($id, 'Vacancy deleted successfully');
    }
}
