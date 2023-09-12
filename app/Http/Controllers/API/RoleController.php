<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\RoleServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RoleController extends BaseController
{
    public function __construct(protected RoleRepositoryContract $repository, protected RoleServiceContract $service)
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => 'required|max:255|unique:roles,name',
            'display_name' => 'nullable|max:255',
        ]);

        return Response::created([
            'role' => $this->service->store($data),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($model, Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => "max:255|unique:roles,name,$model->id",
            'display_name' => 'nullable|max:255',
        ]);

        return Response::updated($this->service->update($model, $data));
    }

    public function givePermissionTo($model, Request $request)
    {
        $data = $this->customValidate($request, [
            'permission_names' => 'required|array',
        ]);

        return Response::resource(
            $this->service->givePermissionTo($model, $data),
            'Permission has been successfully added to the role.'
        );
    }

    public function syncPermissions($model, Request $request)
    {
        $data = $this->customValidate($request, [
            'permission_names' => 'required|array',
        ]);

        return Response::resource(
            $this->service->syncPermissions($model, $data),
            'Permissions have been successfully synchronized for the role.'
        );
    }

    public function revokePermissionTo($model, Request $request)
    {
        $data = $this->customValidate($request, [
            'permission_names' => 'required|array',
        ]);

        return Response::resource(
            $this->service->revokePermissionTo($model, $data),
            'Permission has been successfully removed from the role.'
        );
    }
}
