<?php

namespace App\Services\UserService\RegisterUserService;

/**
 * interface IRegisterUserRequest
 * @package App\Services\UserService\RegisterUserService
 */
interface IRegisterUserRequest
{
    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return string
     */
    public function getEmailAddress(): string;

    /**
     * @return string
     */
    public function getMobileNumber(): string;

    /**
     * @return string
     */
    public function getPassword(): string;

    /**
     * @return bool
     */
    public function getPasswordResetRequired(): bool;

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @return bool
     */
    public function getIsMfaEnabled(): bool;

    /**
     * @return string|null
     */
    public function getMfaToken(): ?string;

    /**
     * @return \DateTime|null
     */
    public function getMfaExpiration(): ?\DateTime;
}
