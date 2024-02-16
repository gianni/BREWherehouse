<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;
use Exception;

class UserController extends AuthController
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @unauthenticated
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = auth()->attempt($credentials);
        abort_unless($token, 401, 'Credentials not valid');

        $user = Auth::user();
        $token = Auth::fromUser($user);

        return response()->json([
            'user' => new UserResource($user),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
        
    }

    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        } catch(Exception $e) {
            abort(401,'Unauthorized');
        }
    }

    public function refresh()
    {
        try {
            return response()->json([
                'user' => new UserResource(Auth::user()),
                'authorization' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ]);
        } catch(Exception $e) {
            abort(401,'Unauthorized');
        }
    }

    public function me()
    {
        try {
            return new UserResource(Auth::user());
        } catch(Exception $e) {
            abort(401,'Unauthorized');
        }
    }
}
