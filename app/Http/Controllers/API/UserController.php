<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\UserUpdateRequest;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends BaseController
{
    public function __construct(protected UserRepositoryContract $repository, protected UserServiceContract $service)
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'confirmed'
        ]);

        return Response::created([
            'resource' => $this->service->store($data),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($model, UserUpdateRequest $request)
    {
        $data = $request->validated();

        return Response::updated($this->service->update($model, $data));
    }
}
