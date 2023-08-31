<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\RoleServiceContract;
use Carbon\Carbon;
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
        $data = $this->customValidate($request->except('guard_name'), [
            'name' => 'required|max:255|unique:post_categories,name',
            'display_name' => 'nullable|max:255',
        ]);

        if ($request->deleted_at) {
            $data['deleted_at'] = Carbon::parse($request->deleted_at)->format('Y-m-d H:i:s');
        }

        $data['guard_name'] = 'api';

        return Response::created([
            'category' => $this->repository->create($data),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $this->customValidate($request->all(), [
            'id' => 'required|integer|exists:roles,id',
            'name' => 'max:255|unique:roles,name',
            'display_name' => 'nullable|max:255',
            'deleted_at' => 'nullable|regex:#\d{4}[-/]\d{2}[-/]\d{2}(?: \d{2}(?::\d{2}){2})?$#',
        ]);

        if ($request->deleted_at) {
            $data['deleted_at'] = Carbon::parse($request->deleted_at)->format('Y-m-d H:i:s');
        }

        $data['guard_name'] = 'api';

        return Response::updated([
            'category' => $this->repository->updateById($request->id, $data),
        ]);
    }

    public function givePermissionTo(Request $request)
    {
        $this->customValidate($request->all(), [
            'id' => 'required|integer|exists:roles,id',
            'permission_ids' => 'required|array',
        ]);

        $role = $this->service->givePermissionTo($request->id, $request->permission_ids);

        return Response::jsonResponse(true, 'bla bla', [$role]);
    }

    public function syncPermissions(Request $request)
    {
        $this->customValidate($request->all(), [
            'id' => 'required|integer|exists:roles,id',
            'permission_ids' => 'required|array',
        ]);

        $role = $this->service->syncPermissions($request->id, $request->permission_ids);

        return Response::jsonResponse(true, 'bla bla', [$role]);
    }

    public function revokePermissionTo(Request $request)
    {
        $this->customValidate($request->all(), [
            'id' => 'required|integer|exists:roles,id',
            'permission_ids' => 'required|array',
        ]);

        $role = $this->service->revokePermissionTo($request->id, $request->permission_ids);

        return Response::jsonResponse(true, 'bla bla', [$role]);
    }
}
