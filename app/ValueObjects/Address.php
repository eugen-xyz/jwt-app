<?php

namespace App\ValueObjects;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Address
 * @package App\Entities
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @ORM\Column(type="string", nullable=true)
     * @var ?string
     */
    protected ?string $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var ?string
     */
    protected ?string $suburb;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var ?string
     */
    protected ?string $postCode;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var ?string
     */
    protected ?string $state;

    /**
     * @param string|null $address
     * @param string|null $suburb
     * @param string|null $postCode
     * @param string|null $state
     */
    public function __construct(?string $address, ?string $suburb, ?string $postCode, ?string $state)
    {
        $this->address = $address;
        $this->suburb = $suburb;
        $this->postCode = $postCode;
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getPrettyString(): string{
        $buffer = array(
            $this->address,
            $this->suburb,
            $this->state,
            $this->postCode
        );

        return implode(', ', array_filter($buffer));
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getSuburb(): ?string
    {
        return $this->suburb;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }
}
