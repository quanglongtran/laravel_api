<?php

namespace App\Http\Controllers\API;

use App\Repositories\Contracts\PostCategoryRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostCategoryController extends BaseController
{
    public function __construct(protected PostCategoryRepositoryContract $repository)
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->customValidate($request->all(), [
            'name' => 'required|max:255|unique:post_categories,name',
            'description' => 'required|max:255',
        ]);

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
            'id' => 'required|integer|exists:post_categories,id',
            'name' => "string|max:255|unique:post_categories,name,{$request->id}",
            'description' => 'string|max:255',
        ]);

        return Response::updated([
            'category' => $this->repository->updateById($request->id, $data),
        ]);
    }
}
