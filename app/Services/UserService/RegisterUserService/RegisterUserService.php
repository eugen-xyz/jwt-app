<?php

namespace App\Services\UserService\RegisterUserService;

use App\Entities\User\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;

/**
 * class RegisterUserService
 * @package App\Services\UserService\RegisterUserService
 */
class RegisterUserService
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(private EntityManager $entityManager)
    {
    }

    /**
     * @param IRegisterUserRequest $request
     * @return User
     * @throws ORMException
     * @throws \Exception
     */
    public function handle(IRegisterUserRequest $request): User
    {
        $user = new User(
            $request->getFirstName(),
            $request->getLastName(),
            $request->getEmailAddress(),
            $request->getMobileNumber(),
            $request->getPassword(),
            $request->getIsActive(),
            $request->getIsMfaEnabled(),
            $request->getPasswordResetRequired(),
        );

        $this->entityManager->persist($user);

        return $user;
    }
}
