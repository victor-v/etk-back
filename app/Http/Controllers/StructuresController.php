<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStructuresRequest;
use App\Http\Requests\UpdateStructuresRequest;
use App\Repositories\v1\StructuresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StructuresController extends AppBaseController
{
    /** @var  StructuresRepository */
    private $structuresRepository;

    public function __construct(StructuresRepository $structuresRepo)
    {
        $this->structuresRepository = $structuresRepo;
    }

    /**
     * Display a listing of the Structures.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->structuresRepository->pushCriteria(new RequestCriteria($request));
        $structures = $this->structuresRepository->all();

        return view('structures.index')
            ->with('structures', $structures);
    }

    /**
     * Show the form for creating a new Structures.
     *
     * @return Response
     */
    public function create()
    {
        return view('structures.create');
    }

    /**
     * Store a newly created Structures in storage.
     *
     * @param CreateStructuresRequest $request
     *
     * @return Response
     */
    public function store(CreateStructuresRequest $request)
    {
        $input = $request->all();

        $structures = $this->structuresRepository->create($input);

        Flash::success('Structures saved successfully.');

        return redirect(route('structures.index'));
    }

    /**
     * Display the specified Structures.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            Flash::error('Structures not found');

            return redirect(route('structures.index'));
        }

        return view('structures.show')->with('structures', $structures);
    }

    /**
     * Show the form for editing the specified Structures.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            Flash::error('Structures not found');

            return redirect(route('structures.index'));
        }

        return view('structures.edit')->with('structures', $structures);
    }

    /**
     * Update the specified Structures in storage.
     *
     * @param  int              $id
     * @param UpdateStructuresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStructuresRequest $request)
    {
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            Flash::error('Structures not found');

            return redirect(route('structures.index'));
        }

        $structures = $this->structuresRepository->update($request->all(), $id);

        Flash::success('Structures updated successfully.');

        return redirect(route('structures.index'));
    }

    /**
     * Remove the specified Structures from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $structures = $this->structuresRepository->findWithoutFail($id);

        if (empty($structures)) {
            Flash::error('Structures not found');

            return redirect(route('structures.index'));
        }

        $this->structuresRepository->delete($id);

        Flash::success('Structures deleted successfully.');

        return redirect(route('structures.index'));
    }
}
