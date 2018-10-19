<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\CreateUsersAPIRequest;
use App\Http\Requests\API\v1\UpdateUsersAPIRequest;
use App\Models\Users;
use App\Repositories\v1\UsersRepository;
use Illuminate\Http\Request;
use Response;
use App\User;

/**
 * Class usersController
 * @package App\Http\Controllers\API\v1
 */

class UsersLoginAPIController extends AppAPIBaseController
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
    public function login(Request $request)
    {

        $request->validate([
            'pin' => 'required|string',
            'password' => 'required|string'
        ]);
        $credentials = request(['pin', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        //TODO настроить на 60 сек
//        if ($request->remember_me)
//            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function signup(Request $request)
    {
        //TODO валидация нужно обсудить, нужно ли запрашивать данные на этапе вставки
        $request->validate([
            'pin' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'user_pin_user' => $request->pin,
            'password' => bcrypt($request->password)
        ]);
        $user->saveOrFail();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
}
