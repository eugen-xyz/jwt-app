<?php

namespace App\ValueObjects\Finance\FinancialQuantity\Cents;

Use App\ValueObjects\Finance\FinancialQuantity\IFinancialQuantity;

/**
 * Class Cents
 * @package FinancialQuantity\Cents
 */
class Cents implements IFinancialQuantity{

    /** cents
     *
     *  Stores the cents in an integer.
     *
     * @var int
     */
    protected $cents;

    /** __construct
     *
     *  Construct a cents object passing in the number of cents as an integer.
     *
     * @param $cents
     * @throws EInstantiationError
     */
    public function __construct($cents){
        if (is_int($cents)){
            $this->cents = $cents;
        }else if (is_float($cents)){
            $this->cents = (int)round($cents, 0, PHP_ROUND_HALF_UP);
        }else{
            throw new EInstantiationError(gettype($cents));
        }
    }

    /** asCentsInt
     *
     *  Returns the value of this quantity in cents.
     *
     * @return integer
     */
    public function asCentsInt(){
        return $this->cents;
    }

    /** equal
     *
     *  Returns TRUE if the cents are equal.
     *
     * @param Cents $cents
     * @return bool
     */
    public function equal(Cents $cents){
        return $this->cents == $cents->asCentsInt();
    }
} 