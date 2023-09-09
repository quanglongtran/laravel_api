<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\PostThreadRepositoryContract;
use App\Services\Contracts\PostThreadServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostThreadController extends BaseController
{
    public function __construct(protected PostThreadRepositoryContract $repository, protected PostThreadServiceContract $service)
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request, [
            'name' => 'required|max:255|unique:post_threads,name',
            'description' => 'required|max:255',
            'post_category_id' => 'required|integer|exists:post_categories,id'
        ]);

        return Response::created([
            'thread' => $this->service->store($data),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($model, Request $request)
    {
        $data = $this->customValidate($request, [
            'post_category_id' => 'integer|exists:post_categories,id',
            'name' => "string|max:255|unique:post_threads,name,{$model->id}",
            'description' => 'string|max:255',
        ]);

        return Response::updated($this->service->update($model, $data));
    }
}
