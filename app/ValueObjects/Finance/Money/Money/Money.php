<?php

namespace App\ValueObjects\Finance\Money\Money;

use App\ValueObjects\Finance\Currency\AUD\AUD;
use App\ValueObjects\Finance\Currency\Currency;
use App\ValueObjects\Finance\FinancialQuantity\Cents\Cents;
use App\ValueObjects\Finance\FinancialQuantity\IFinancialQuantity;
use App\ValueObjects\Finance\Money\EAllocationsNotAccurate;
use App\ValueObjects\Finance\Money\EValueNotAllowed;
use App\ValueObjects\Finance\Money\IMoney;
use App\ValueObjects\Finance\Money\EIncompatibleCurrencies;

/**
 * Class Money
 * @package Money
 */
class Money implements IMoney
{

    /** cents
     *
     *  Represents the cents this money class holds.
     *
     * @var \App\ValueObjects\Finance\FinancialQuantity\Cents\Cents
     */
    protected $cents;

    /** currency
     *
     *  Represents the currency of this money class.
     *
     * @var \App\ValueObjects\Finance\Currency\Currency
     */
    protected $currency;

    /** __construct
     *
     *  Construct
     * @param IFinancialQuantity $quantity
     * @param Currency $currency
     */
    public function __construct(IFinancialQuantity $quantity, Currency $currency = NULL)
    {
        if (!$currency) {
            $currency = new AUD();
        }
        $this->cents = new Cents($quantity->asCentsInt());
        $this->currency = $currency;
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return (null === $this->cents() && null === $this->currency());
    }

    /** cents
     *
     *  Returns the cents of this money.
     *
     * @return Cents
     */
    public function cents()
    {
        return $this->cents;
    }

    /**
     * @return float
     */
    public function toDollarFloat(): float
    {
        return round($this->cents->asCentsInt() / 100, 2);
    }

    /** currency
     *
     *  Returns the currency of this object.
     *
     * @return Currency
     */
    public function currency()
    {
        return $this->currency;
    }

    /** currenciesMatch
     *
     *  Returns TRUE if the currencies match.
     *
     * @param IMoney $comparator
     * @return bool
     */
    public function currenciesMatch(IMoney $comparator)
    {
        return $comparator->currency() instanceof $this->currency;
    }

    /** lessThan
     *
     *  Returns TRUE if the comparator is less than this money. Throws an exception if the currencies
     *  are different.
     *
     * @param IMoney $comparator
     * @return boolean
     * @throws EIncompatibleCurrencies
     */
    public function lessThan(IMoney $comparator)
    {
        if ($this->currenciesMatch($comparator)) {
            return $this->cents->asCentsInt() < $comparator->cents()->asCentsInt();
        } else {
            throw new EIncompatibleCurrencies();
        }
    }

    /** lessThanEqual
     *
     *  Returns TRUE if the comparator is less than or equal to this money. Throws an exception if the currencies
     *  are different.
     *
     * @param IMoney $comparator
     * @return bool
     * @throws EIncompatibleCurrencies
     */
    public function lessThanEqual(IMoney $comparator)
    {
        if ($this->currenciesMatch($comparator)) {
            return $this->cents->asCentsInt() <= $comparator->cents()->asCentsInt();
        } else {
            throw new EIncompatibleCurrencies();
        }
    }

    /** greaterThan
     *
     *  Returns TRUE if the comparator is greater than this money. Throws an exception if the currencies
     *  are different.
     *
     * @param IMoney $comparator
     * @return bool
     * @throws EIncompatibleCurrencies
     */
    public function greaterThan(IMoney $comparator)
    {
        if ($this->currenciesMatch($comparator)) {
            return $this->cents->asCentsInt() > $comparator->cents()->asCentsInt();
        } else {
            throw new EIncompatibleCurrencies();
        }
    }

    /** greaterThanEqual
     *
     *  Returns TRUE if the comparator is greater than or equal to this money. Throws an exception if the currencies
     *  are different.
     *
     * @param IMoney $comparator
     * @return boolean
     * @throws EIncompatibleCurrencies
     */
    public function greaterThanEqual(IMoney $comparator)
    {
        if ($this->currenciesMatch($comparator)) {
            return $this->cents->asCentsInt() >= $comparator->cents()->asCentsInt();
        } else {
            throw new EIncompatibleCurrencies();
        }
    }

    /** equal
     *
     *  Returns TRUE if the comparator matches this money exactly, both in cents and currency.
     *
     * @param IMoney $comparator
     * @return boolean
     */
    public function equal(IMoney $comparator)
    {
        return $this->currenciesMatch($comparator) && $this->cents()->equal($comparator->cents());
    }

    /** addQuantity
     *
     *  Adds the given quantity to the current quantity and returns a new money object.
     *
     * @param IFinancialQuantity $quantity
     * @return Money
     */
    public function addQuantity(IFinancialQuantity $quantity)
    {
        $newRawQuantity = $this->cents()->asCentsInt() + $quantity->asCentsInt();
        return new self(new Cents($newRawQuantity), $this->currency());
    }

    /** addMoney
     *
     *  Adds the given money to the current money and returns a new money object.
     *
     * @param IMoney $money
     * @return Money
     * @throws \DomainLayer\Finance\Money\EIncompatibleCurrencies
     */
    public function addMoney(IMoney $money)
    {
        if ($this->currenciesMatch($money)) {
            $newRawQuantity = $this->cents()->asCentsInt() + $money->cents()->asCentsInt();
            return new self(new Cents($newRawQuantity), $this->currency());
        }
        throw new EIncompatibleCurrencies();
    }

    /** subtractQuantity
     *
     *  Subtracts the given quantity to the current quantity and returns a new money object.
     *
     * @param IFinancialQuantity $quantity
     * @return Money
     */
    public function subtractQuantity(IFinancialQuantity $quantity)
    {
        $newRawQuantity = $this->cents()->asCentsInt() - $quantity->asCentsInt();
        return new self(new Cents($newRawQuantity), $this->currency());
    }

    /** subtractMoney
     *
     *  Subtracts the given money to the current money and returns a new money object.
     *
     * @param IMoney $money
     * @return Money
     * @throws \DomainLayer\Finance\Money\EIncompatibleCurrencies
     */
    public function subtractMoney(IMoney $money)
    {
        if ($this->currenciesMatch($money)) {
            $newRawQuantity = $this->cents()->asCentsInt() - $money->cents()->asCentsInt();
            return new self(new Cents($newRawQuantity), $this->currency());
        }
        throw new EIncompatibleCurrencies();
    }

    /** multiplyBy
     *
     *  Multiplies the given money interest by the multiplier and returns a new money object.
     *  The multiplier can be an integer or a float. The round method determines how the money
     *  object will round; the default is PHP_ROUND_HALF_UP.
     *
     * @param $multiplier
     * @param int $roundMethod
     * @return Money
     * @throws EValueNotAllowed
     */
    public function multiplyBy($multiplier, $roundMethod = PHP_ROUND_HALF_UP)
    {
        if (is_numeric($multiplier)) {
            $product = round($this->cents->asCentsInt() * $multiplier, 0, $roundMethod);
            return new self(new Cents((int)$product), $this->currency());
        }
        throw new EValueNotAllowed();
    }

    /** isPositive
     *
     *  Returns TRUE if the money value is positive or zero. FALSE otherwise.
     *
     * @return bool
     */
    public function isPositive()
    {
        return $this->cents()->asCentsInt() >= 0;
    }

    /** isZero
     *
     *  Returns TRUE if the money is of zero worth, FALSE otherwise.
     *
     * @return bool
     */
    public function isZero()
    {
        return $this->cents()->asCentsInt() === 0;
    }

    /** allocate
     *
     *  Allocates the current quantity of money into N pieces distributed as per the arguments. This is a
     *  variadic function and accepts an arbitrary number of parameters. Each parameter must define a percentage allocation
     *  in any form satisfying the is_numeric function (float, string or int). For example, allocate(40, 60) will return
     *  an array of two money objects, one with 40% of the original quantity and the other with 60%.
     *
     * @return array
     * @throws \DomainLayer\Finance\Money\EAllocationsNotAccurate
     */
    public function allocate()
    {
        /** Ensure our percentages add up to 100% */
        if (100 != array_sum(func_get_args())) {
            throw new EAllocationsNotAccurate();
        }

        /** Get the percentages and guard to ensure all are valid percentages */
        $percentages = func_get_args();

        /** We figure out what each balance should have if we could be exact. We use these to continuously
         *  check how far off we are. */
        $exactBalances = [];
        $allocation = [];
        foreach ($percentages as $aPercent) {
            if (!is_numeric($aPercent) || $aPercent < 0 || $aPercent > 100) {
                throw new EAllocationsNotAccurate();
            }

            $exactBalances[] = ($this->cents()->asCentsInt() * $aPercent) / 100;
            $allocation[] = 0;
        }

        /** We now add one cent to each percentage until we hit it's requirement as closely as possible */
        $total = $this->cents()->asCentsInt();
        while ($total > 0) {
            for ($i = 0; $i < count($allocation); $i++) {
                if ($allocation[$i] < $exactBalances[$i]) {
                    $allocation[$i]++;
                    $total--;
                }

                if (0 === $total) {
                    break;
                }
            }
        }

        $monies = [];
        foreach ($allocation as $anAllocation) {
            $monies[] = new Money(new Cents($anAllocation), $this->currency());
        }

        return $monies;
    }
}
