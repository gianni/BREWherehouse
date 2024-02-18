<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
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
            ],
        ]);

    }

    public function me()
    {
        return new UserResource(Auth::user());
    }
}
