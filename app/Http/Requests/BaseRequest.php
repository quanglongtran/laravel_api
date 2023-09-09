<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Validator;

use function App\Commons\coalesce;

abstract class BaseRequest extends FormRequest
{
    public function withValidator(\Illuminate\Validation\Validator $validator)
    {
        $data = $validator->getData();
        $rules = $this->rules();
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

        $validator = Validator::make($data, $relations->map(fn () => 'json_object')->merge($rules)->toArray());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
