<?php

namespace App\ValueObjects\Finance\Money;

Use App\ValueObjects\Finance\FinancialQuantity\IFinancialQuantity;

/**
 * Interface IMoney
 * @package Money
 */
interface IMoney{

    /**
     * @return \DomainLayer\Finance\FinancialQuantity\Cents\Cents
     */
    public function cents();

    /**
     * @return \DomainLayer\Finance\Currency\Currency
     */
    public function currency();

    /**
     * @param IMoney $comparator
     * @throws EIncompatibleCurrencies
     * @return boolean
     */
    public function lessThan(IMoney $comparator);

    /**
     * @param IMoney $comparator
     * @return boolean
     */
    public function lessThanEqual(IMoney $comparator);

    /**
     * @param IMoney $comparator
     * @return boolean
     */
    public function greaterThan(IMoney $comparator);

    /**
     * @param IMoney $comparator
     * @return boolean
     */
    public function greaterThanEqual(IMoney $comparator);

    /**
     * @param IMoney $comparator
     * @return boolean
     */
    public function equal(IMoney $comparator);

    /**
     * @param IFinancialQuantity $quantity
     * @return IMoney
     */
    public function addQuantity(IFinancialQuantity $quantity);

    /**
     * @param IMoney $money
     * @return IMoney
     */
    public function addMoney(IMoney $money);

    /**
     * @param IFinancialQuantity $quantity
     * @return IMoney
     */
    public function subtractQuantity(IFinancialQuantity $quantity);

    /**
     * @param IMoney $money
     * @return IMoney
     */
    public function subtractMoney(IMoney $money);

    /**
     * @param $multiplier
     * @param int $roundMethod
     * @return IMoney
     */
    public function multiplyBy($multiplier, $roundMethod = PHP_ROUND_HALF_UP);

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
    public function allocate();

    /** isPositive
     *
     *  Returns TRUE if the money value is positive or zero. FALSE otherwise.
     *
     * @return bool
     */
    public function isPositive();

    /** isZero
     *
     *  Returns TRUE if the money is of zero worth, FALSE otherwise.
     *
     * @return bool
     */
    public function isZero();

}