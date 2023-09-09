<?php

namespace App\Http\Controllers\API;

use App\Commons\HttpStatusCodes;
use App\Http\Requests\API\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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
            return Response::jsonResponse(false, 'Incorrect account or password', [], HttpStatusCodes::HTTP_UNAUTHORIZED);
        }

        return Response::jsonResponse(true, 'Logged in successfully', $this->createNewToken($token));
    }

    public function register(Request $request)
    {
        $validated = $this->customValidate($request->only(['email', 'password', 'name']), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|min:4|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($validated);

        return Response::jsonResponse(true, 'User created successfully', ['user' => $user], HttpStatusCodes::HTTP_CREATED);
    }

    public function profile()
    {
        return Response::resource(Auth::user());
    }

    public function update(UserUpdateRequest $request)
    {
        return Response::updated(tap(Auth::user(), fn ($user) => $user->update($request->validated())));
    }

    public function logout()
    {
        Auth::logout();
        return Response::jsonResponse(true, 'Successfully logged out');
    }

    public function refresh()
    {
        return Response::jsonResponse(true, 'Refreshing success', $this->createNewToken(Auth::refresh()));
    }

    public function createNewToken(string $token)
    {
        return [
            'user' => Auth::user(),
            'authorization' => [
                'token' => $token,
                'type' => 'Bearer',
                'expired_at' => JWTAuth::decode(new Token($token))->get('exp'),
            ]
        ];
    }
}
