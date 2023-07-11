<?php

namespace App\DatabaseTypes;
use App\ValueObjects\Finance\Currency\AUD\AUD;
use App\ValueObjects\Finance\FinancialQuantity\Cents\Cents;
use App\ValueObjects\Finance\Money\Money\Money;

/**
 * Class MoneyObject
 * @package App\DatabaseTypes
 */
class MoneyObject extends \Doctrine\DBAL\Types\Type
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
        return "INTEGER";
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     */
    public function getName()
    {
        return "MoneyObject";
    }

    public function convertToPhpValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform)
    {
        if (null === $value){
            return null;
        }
        
        return new Money(new Cents((int)$value), new AUD());
    }

    public function convertToDatabaseValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform)
    {
        /** @var $value Money */
        if (null === $value){
            return null;
        }

        return $value->cents()->asCentsInt();
    }

}