<?php

namespace App\Entities\User;

use Doctrine\ORM\Mapping as ORM;

use App\Entities\Entity;
use Illuminate\Support\Facades\Hash;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthContract;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * class User
 * @package App\Entities;
 * @ORM\Entity
 */
class User extends Entity implements JWTSubject, AuthContract
{
    use Authenticatable;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @var string
     */
    private string $emailAddress;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private string $mobileNumber;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private bool $passwordResetRequired;

    /**
     * @ORM\Column (type="boolean")
     * @var bool
     */
    private bool $isActive;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private bool $mfaEnabled;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private ?string $mfaToken = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime|null
     */
    private ?\DateTime $mfaExpiration = null;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $emailAddress
     * @param string $mobileNumber
     * @param string $password
     * @param bool $isActive
     * @param bool $mfaEnabled
     * @param bool $passwordResetRequired
     * @throws \Exception
     */
    public function __construct(
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $mobileNumber,
        string $password,
        bool   $isActive,
        bool   $mfaEnabled,
        bool   $passwordResetRequired
    )
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmailAddress($emailAddress);
        $this->setMobileNumber($mobileNumber);
        $this->setPassword($password);
        $this->setIsActive($isActive);
        $this->setMfaEnabled($mfaEnabled);
        $this->setPasswordResetRequired($passwordResetRequired);
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return void
     * @throws \Exception
     */
    public function setFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new \Exception('First name is required');
        }

        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return void
     * @throws \Exception
     */
    public function setLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new \Exception('Last name is required');
        }

        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return void
     * @throws \Exception
     */
    public function setEmailAddress(string $emailAddress): void
    {
        if (empty($emailAddress)) {
            throw new \Exception('Email address is required');
        }

        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getMobileNumber(): string
    {
        return $this->mobileNumber;
    }

    /**
     * @param string $mobileNumber
     * @return void
     * @throws \Exception
     */
    public function setMobileNumber(string $mobileNumber): void
    {
        if (empty($mobileNumber)) {
            throw new \Exception('Mobile number is required');
        }

        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     * @throws \Exception
     */
    public function setPassword(string $password): void
    {
        if (empty($password)) {
            throw new \Exception('Password is required');
        }
        $this->password = Hash::make($password);
    }

    /**
     * @return bool
     */
    public function isPasswordResetRequired(): bool
    {
        return $this->passwordResetRequired;
    }

    /**
     * @param bool $passwordResetRequired
     */
    public function setPasswordResetRequired(bool $passwordResetRequired): void
    {
        $this->passwordResetRequired = $passwordResetRequired;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isMfaEnabled(): bool
    {
        return $this->mfaEnabled;
    }

    /**
     * @param bool $mfaEnabled
     */
    public function setMfaEnabled(bool $mfaEnabled): void
    {
        $this->mfaEnabled = $mfaEnabled;
    }

    /**
     * @return string|null
     */
    public function getMfaToken(): ?string
    {
        return $this->mfaToken;
    }

    /**
     * @param string|null $mfaToken
     */
    public function setMfaToken(?string $mfaToken): void
    {
        if (empty(($mfaToken))) {
            $mfaToken = null;
        }

        $this->mfaToken = $mfaToken;
    }

    /**
     * @return \DateTime|null
     */
    public function getMfaExpiration(): ?\DateTime
    {
        return $this->mfaExpiration;
    }

    /**
     * @param \DateTime|null $mfaExpiration
     */
    public function setMfaExpiration(?\DateTime $mfaExpiration): void
    {
        $this->mfaExpiration = $mfaExpiration;
    }


    /**
     * @return mixed|string
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getId();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
