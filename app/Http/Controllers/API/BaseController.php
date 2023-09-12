<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use function App\Commons\coalesce;

/**
 * @property \App\Repositories\Contracts\BaseRepositoryContract $repository
 */
class BaseController extends Controller
{
    public function customValidate(array|Request $data = [], array $rules = [], array $customMessage = [], array $attributes = [])
    {
        if ($data instanceof Request) {
            $data = $data->all();
        }

        $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        foreach ($dates as $date) {
            if (array_key_exists($date, $data)) {
                $rules[$date] = coalesce($rules, $date, 'date_format:Y-m-d');
            }
        }

        $relations = collect($data)->filter(fn ($_, $name) => preg_match('/^with_/', $name));

        $validator = Validator::make($data, $relations->map(fn () => 'json_object')->merge($rules)->toArray(), $customMessage, $attributes);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $resourceName = 'resource')
    {
        $this->customValidate($request);
        $resource = $this->repository->filter($request->all());

        return Response::jsonResponse(true, "Returned a list of {$resource->count()} records", [
            $resourceName => $resource
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($model)
    {
        return Response::resource($model);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($model)
    {
        return tap(Response::deleted(), fn () => $model->forceDelete());
    }

    /**
     * Softly deletes a record from the data table
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($model)
    {
        return tap(Response::deleted(), fn () => $model->delete());
    }

    /**
     * Restore a soft-deleted model instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($model)
    {
        return tap(Response::restored($model), fn () => $model->restore());
    }

    // Fallback
    public function __call($method, $parameters)
    {
        return Response::developing();
    }
}
