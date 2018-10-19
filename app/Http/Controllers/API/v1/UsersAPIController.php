<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\v1\CreateUsersAPIRequest;
use App\Http\Requests\API\v1\UpdateUsersAPIRequest;
use App\Models\Users;
use App\Repositories\v1\UsersRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class usersController
 * @package App\Http\Controllers\API\v1
 */

class UsersAPIController extends AppAPIBaseController
{
    /** @var  usersRepository */
    private $UsersRepository;

    public function __construct(UsersRepository $UsersRepo)
    {
        $this->UsersRepository = $UsersRepo;
    }

    /**
     * Display a listing of the users.
     * GET|HEAD /Users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request -> all();
        $Users = $this->UsersRepository->all();

        return $this->sendResponse($Users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created users in storage.
     * POST /Users
     *
     * @param CreateusersAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateusersAPIRequest $request)
    {
        $input = $request->all();

        $Users = $this->UsersRepository->create($input);

        return $this->sendResponse($Users->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified users.
     * GET|HEAD /Users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var users $Users */
        $Users = $this->UsersRepository->findWithoutFail($id);

        if (empty($Users)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($Users->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified users in storage.
     * PUT/PATCH /Users/{id}
     *
     * @param  int $id
     * @param UpdateUsersAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateusersAPIRequest $request)
    {
        $input = $request->all();

        /** @var users $Users */
        $Users = $this->UsersRepository->findWithoutFail($id);

        if (empty($Users)) {
            return $this->sendError('User not found');
        }

        $Users = $this->UsersRepository->update($input, $id);

        return $this->sendResponse($Users->toArray(), 'users updated successfully');
    }

    /**
     * Remove the specified users from storage.
     * DELETE /Users/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var users $Users */
        $Users = $this->UsersRepository->findWithoutFail($id);

        if (empty($Users)) {
            return $this->sendError('User not found');
        }

        $Users->delete();

        return $this->sendResponse($id, 'User deleted successfully');
    }
}
