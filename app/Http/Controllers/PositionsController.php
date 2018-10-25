<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePositionsRequest;
use App\Http\Requests\UpdatePositionsRequest;
use App\Repositories\v1\PositionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PositionsController extends AppBaseController
{
    /** @var  PositionsRepository */
    private $positionsRepository;

    public function __construct(PositionsRepository $positionsRepo)
    {
        $this->positionsRepository = $positionsRepo;
    }

    /**
     * Display a listing of the Positions.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->positionsRepository->pushCriteria(new RequestCriteria($request));
        $positions = $this->positionsRepository->all();

        return view('positions.index')
            ->with('positions', $positions);
    }

    /**
     * Show the form for creating a new Positions.
     *
     * @return Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created Positions in storage.
     *
     * @param CreatePositionsRequest $request
     *
     * @return Response
     */
    public function store(CreatePositionsRequest $request)
    {
        $input = $request->all();

        $positions = $this->positionsRepository->create($input);

        Flash::success('Positions saved successfully.');

        return redirect(route('positions.index'));
    }

    /**
     * Display the specified Positions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            Flash::error('Positions not found');

            return redirect(route('positions.index'));
        }

        return view('positions.show')->with('positions', $positions);
    }

    /**
     * Show the form for editing the specified Positions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            Flash::error('Positions not found');

            return redirect(route('positions.index'));
        }

        return view('positions.edit')->with('positions', $positions);
    }

    /**
     * Update the specified Positions in storage.
     *
     * @param  int              $id
     * @param UpdatePositionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePositionsRequest $request)
    {
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            Flash::error('Positions not found');

            return redirect(route('positions.index'));
        }

        $positions = $this->positionsRepository->update($request->all(), $id);

        Flash::success('Positions updated successfully.');

        return redirect(route('positions.index'));
    }

    /**
     * Remove the specified Positions from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $positions = $this->positionsRepository->findWithoutFail($id);

        if (empty($positions)) {
            Flash::error('Positions not found');

            return redirect(route('positions.index'));
        }

        $this->positionsRepository->delete($id);

        Flash::success('Positions deleted successfully.');

        return redirect(route('positions.index'));
    }
}
