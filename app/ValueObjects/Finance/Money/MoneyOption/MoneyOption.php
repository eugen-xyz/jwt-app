<?php

namespace App\ValueObjects\Finance\Money\MoneyOption;

Use App\ValueObjects\Finance\Currency\AUD\AUD;
Use App\ValueObjects\Finance\FinancialQuantity\Cents\Cents;
Use App\ValueObjects\Finance\Money\Money\Money;

/**
 * Class MoneyOption
 *
 *  This class implements the option type pattern, with the aim of making optional values
 *  more type sensitive and less prone to error.
 *
 * @package Budgeting\Expense\MoneyOption
 */
class MoneyOption{

    /** $value
     *
     *  This variable can either be of type Money or NULL.
     *
     * @var \App\ValueObjects\Finance\Money\Money\Money | NULL
     */
    protected $value;

    /** createAround
     *
     *  Creates an option type around the given money.
     *
     * @param Money $money
     * @return MoneyOption
     */
    static public function createAround(Money $money){
        $obj = new self();
        $obj->setAsMoney($money);
        return $obj;
    }

    /** getValue
     *
     *  Returns the money object if defined, and the given $default if the internal
     *  money object is NULL.
     *
     * @param $default
     * @return Money
     */
    public function getValue($default){
        if (NULL == $this->value){
            return $default;
        }
        return $this->value;
    }

    public function getValueOrNull(){
        return $this->value;
    }

    /** setAsEmpty
     *
     *  Sets the internal money object to NULL;
     *
     */
    public function setAsEmpty(){
        $this->value = NULL;
    }

    /** setAsMoney
     *
     *  Sets the internal money object to that of the money given.
     *
     * @param Money $money
     */
    public function setAsMoney(Money $money){
        $this->value = $money;
    }

    /** isEmpty
     *
     *  Returns TRUE if the internal object is empty, FALSE otherwise.
     *
     * @return bool
     */
    public function isEmpty(){
        return NULL === $this->value;
    }

	/**
	 * @return Money
	 */
    public function getOrFallbackToZero(){
    	if ($this->isEmpty()){
    		return new Money(new Cents(0), new AUD());
		}

		return $this->getValueOrNull();
	}

}