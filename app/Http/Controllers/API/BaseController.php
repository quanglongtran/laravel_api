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

        return $data;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $resourceName = 'resource')
    {
        $data = $request->all();
        $this->customValidate($data, []);

        $resource = $this->repository->filter($data);

        return Response::jsonResponse(true, "Returned a list of {$resource->count()} records", [
            $resourceName => $this->repository->filter($data)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->customValidate($request->all(), [
            'id' => "required|integer|exists:{$this->repository->getTable()},id",
        ]);

        $this->repository->forceDelete($request->id);

        return Response::deleted();
    }

    /**
     * Restore a soft-deleted model instance.
     *
     * @return bool
     */
    public function restore(Request $request)
    {
        $this->customValidate($request->all(), [
            'id' => "required|integer|exists:{$this->repository->getTable()},id",
        ]);

        $this->repository->restore($request->id);

        return Response::jsonResponse(true, 'Resource recovery successful');
    }
}
