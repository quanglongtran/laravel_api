<?php

namespace App\Http\Controllers\API;

use App\Services\Contracts\PostCategoryServiceContract;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostController extends BaseController
{
    public function __construct(protected PostRepositoryContract $repository, protected PostCategoryServiceContract $service)
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => 'required|max:255|unique:posts,name',
            'description' => 'required|max:255',
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
            'name' => "string|max:255|unique:posts,name,{$model->id}",
            'description' => 'string|max:255',
        ]);

        return Response::updated($this->service->update($model, $data));
    }
}
