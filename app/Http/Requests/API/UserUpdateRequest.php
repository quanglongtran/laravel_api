<?php

namespace App\Http\Requests\API;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class UserUpdateRequest extends BaseRequest
{
    private $userRequest;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->userRequest = $this->route('user') ?? ($this->getRequestUri() == '/api/auth/change-info' ? auth()->user() : null);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = $this->userRequest;

        return [
            'name' => "max:255|unique:users,name,$user->id",
            'email' => "max:255|unique:users,email,$user->id",
            'password' => 'confirmed',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $user = $this->userRequest;
        parent::withValidator($validator);
        if ($user->id == 1) {
            $validator->errors()->add('', 'Super admin cannot be updated or deleted.');
            throw new ValidationException($validator);
        }
    }
}
