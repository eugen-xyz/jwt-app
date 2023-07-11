<?php

namespace App\Renderer\User;

use App\Entities\User\User;
use App\Renderer\Renderer;

/**
 * class UserRenderer
 * @package App\Renderer\User
 */
class UserRenderer extends Renderer
{
    /**
     * @param User $user
     * @return array
     */
    public function render(User $user): array
    {
        return [
            'id' => $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'emailAddress' => $user->getEmailAddress(),
            'mobileNumber' => $user->getMobileNumber(),
            'isActive' => $user->isActive() ? 'Yes' : 'No',
        ];
    }
}
