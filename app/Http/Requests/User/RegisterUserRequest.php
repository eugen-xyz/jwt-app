<?php

namespace App\Http\Requests\User;

use App\Entities\User\User;
use App\Services\UserService\RegisterUserService\IRegisterUserRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

/**
 * class RegisterUserRequest
 * @package App\Http\Requests\User
 */
class RegisterUserRequest extends FormRequest implements IRegisterUserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mobileNumberRule = [
            'string',
            'regex: /^(04)([0-9]{8})$/',
//            Rule::unique(User::class, 'mobileNumber'),
        ];

        return [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'emailAddress' => 'required|string|email|unique:'.User::class.',emailAddress',
            'mobileNumber' => $mobileNumberRule,
            'password' => 'required',
            'passwordResetRequired' => 'bool',
            'isActive' => 'bool',
            'isMfaEnabled' => 'bool',
            'mfaToken' => 'nullable|string',
            'mfaExpiration' => 'nullable|date',
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
    public function getFirstName(): string
    {
        return $this->input('firstName');
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->input('lastName');
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

    /**
     * @return string
     */
    public function getMobileNumber(): string
    {
        return $this->input('mobileNumber');
    }

    /**
     * @return bool
     */
    public function getPasswordResetRequired(): bool
    {
        return $this->input('passwordResetRequired');
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->input('isActive');
    }

    /**
     * @return bool
     */
    public function getIsMfaEnabled(): bool
    {
        return $this->input('isMfaEnabled');
    }

    /**
     * @return string|null
     */
    public function getMfaToken(): ?string
    {
        return $this->input('mfaToken') ?? '';
    }

    /**
     * @return \DateTime|null
     */
    public function getMfaExpiration(): ?\DateTime
    {
        return $this->input('mfaExpiration') ?? null;
    }
}
