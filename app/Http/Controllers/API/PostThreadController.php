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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
