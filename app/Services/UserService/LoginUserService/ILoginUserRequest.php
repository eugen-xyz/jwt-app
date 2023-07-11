<?php

namespace App\Services\UserService\LoginUserService;

/**
 * interface ILoginUserRequest
 * @package App\Services\UserService\LoginUserService
 */
interface ILoginUserRequest
{
    /**
     * @return string
     */
    public function getEmailAddress(): string;

    /**
     * @return string
     */
    public function getPassword(): string;
}
