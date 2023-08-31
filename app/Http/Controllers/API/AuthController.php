<?php

namespace App\Http\Controllers\API;

use App\Commons\HttpStatusCodes;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Token;

class AuthController extends BaseController
{
    public function __construct(protected AuthRepositoryContract $repository)
    {
        $this->middleware(['auth:api'])->except(['login', 'register']);
    }

    public function login(Request $request)
    {
        $validated = $this->customValidate($request->only(['email', 'password']), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $token = JWTAuth::attempt($validated);

        if (!$token) {
            return response()->jsonResponse(false, 'Incorrect account or password', [], HttpStatusCodes::HTTP_UNAUTHORIZED);
        }

        return response()->jsonResponse(true, 'Logged in successfully', $this->createNewToken($token));
    }

    public function register(Request $request)
    {
        $validated = $this->customValidate($request->only(['email', 'password', 'name']), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|min:4|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($validated);

        return response()->jsonResponse(true, 'User created successfully', ['user' => $user], HttpStatusCodes::HTTP_CREATED);
    }

    public function logout()
    {
        Auth::logout();
        return response()->jsonResponse(true, 'Successfully logged out');
    }

    public function refresh()
    {
        return response()->jsonResponse(true, 'Refreshing success', $this->createNewToken(Auth::refresh()));
    }

    public function createNewToken(string $token)
    {
        return [
            'user' => Auth::user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expired_at' => JWTAuth::decode(new Token($token))->get('exp'),
            ]
        ];
    }

    public function roles(Request $request)
    {
        return $this->index($request, 'roles');
    }
}
