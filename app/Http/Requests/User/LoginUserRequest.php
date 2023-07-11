<?php

namespace App\Http\Requests\User;

use App\Services\UserService\LoginUserService\ILoginUserRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * class LoginUserRequest
 * @package App\Http\Requests\User
 */
class LoginUserRequest extends FormRequest implements ILoginUserRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'emailAddress' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * @param Validator $validator
     * @return JsonResponse
     */
    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->input('emailAddress');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->input('password');
    }
}
