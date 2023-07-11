<?php

namespace App\DatabaseTypes;

use App\ValueObjects\Percentage;

/**
 * Class PercentageObject
 * @package App\DatabaseTypes
 */
class PercentageObject extends \Doctrine\DBAL\Types\Type
{
    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, \Doctrine\DBAL\Platforms\AbstractPlatform $platform)
    {
        return "FLOAT";
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     */
    public function getName()
    {
        return "PercentageObject";
    }

    public function convertToPhpValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform)
    {
        if (null === $value){
            return null;
        }

        return Percentage::createFromNormalizedFloat((float)$value);
    }

    public function convertToDatabaseValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform)
    {
        /** @var $value Percentage */
        if (null === $value){
            return null;
        }

        return $value->asNormalizedFloat();
    }

}