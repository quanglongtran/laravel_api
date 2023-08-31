<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\PostThreadRepositoryContract;
use Illuminate\Http\Request;
use Response;

class PostThreadController extends BaseController
{
    public function __construct(protected PostThreadRepositoryContract $repository)
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request->all(), [
            'name' => 'required|max:255|unique:post_threads,name',
            'description' => 'required|max:255',
            'post_category_id' => 'required|integer|exists:post_categories,id'
        ]);

        return Response::created([
            'thread' => $this->repository->create($data),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $this->customValidate($request->all(), [
            'id' => 'required|integer|exists:post_threads,id',
            'post_category_id' => 'integer|exists:post_categories,id',
            'name' => "string|max:255|unique:post_categories,name,{$request->id}",
            'description' => 'string|max:255',
        ]);

        return Response::updated([
            'thread' => $this->repository->updateById($request->id, $data),
        ]);
    }
}
