<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\PermissionRepositoryContract;
use App\Services\Contracts\PermissionServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PermissionController extends BaseController
{
    public function __construct(protected PermissionRepositoryContract $repository, protected PermissionServiceContract $service)
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => 'required|max:255|unique:permissions,name',
            'display_name' => 'nullable|max:255',
        ]);

        return Response::created([
            'category' => $this->service->store($data),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($model, Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => "max:255|unique:permissions,name,$model->id",
            'display_name' => 'nullable|max:255',
        ]);

        return Response::updated($this->service->update($model, $data));
    }
}
