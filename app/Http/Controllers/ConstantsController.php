<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConstantsRequest;
use App\Http\Requests\UpdateConstantsRequest;
use App\Repositories\v1\ConstantsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ConstantsController extends AppBaseController
{
    /** @var  ConstantsRepository */
    private $constantsRepository;

    public function __construct(ConstantsRepository $constantsRepo)
    {
        $this->constantsRepository = $constantsRepo;
    }

    /**
     * Display a listing of the Constants.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->constantsRepository->pushCriteria(new RequestCriteria($request));
        $constants = $this->constantsRepository->all();

        return view('constants.index')
            ->with('constants', $constants);
    }

    /**
     * Show the form for creating a new Constants.
     *
     * @return Response
     */
    public function create()
    {
        return view('constants.create');
    }

    /**
     * Store a newly created Constants in storage.
     *
     * @param CreateConstantsRequest $request
     *
     * @return Response
     */
    public function store(CreateConstantsRequest $request)
    {
        $input = $request->all();

        $constants = $this->constantsRepository->create($input);

        Flash::success('Constants saved successfully.');

        return redirect(route('constants.index'));
    }

    /**
     * Display the specified Constants.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            Flash::error('Constants not found');

            return redirect(route('constants.index'));
        }

        return view('constants.show')->with('constants', $constants);
    }

    /**
     * Show the form for editing the specified Constants.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            Flash::error('Constants not found');

            return redirect(route('constants.index'));
        }

        return view('constants.edit')->with('constants', $constants);
    }

    /**
     * Update the specified Constants in storage.
     *
     * @param  int              $id
     * @param UpdateConstantsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConstantsRequest $request)
    {
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            Flash::error('Constants not found');

            return redirect(route('constants.index'));
        }

        $constants = $this->constantsRepository->update($request->all(), $id);

        Flash::success('Constants updated successfully.');

        return redirect(route('constants.index'));
    }

    /**
     * Remove the specified Constants from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $constants = $this->constantsRepository->findWithoutFail($id);

        if (empty($constants)) {
            Flash::error('Constants not found');

            return redirect(route('constants.index'));
        }

        $this->constantsRepository->delete($id);

        Flash::success('Constants deleted successfully.');

        return redirect(route('constants.index'));
    }
}
