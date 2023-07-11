<?php

namespace App\ValueObjects\Finance\FinancialQuantity\Dollars;

Use App\ValueObjects\Finance\FinancialQuantity\IFinancialQuantity;

/**
 * Class Dollars
 * @package FinancialQuantity\Dollars
 */
class Dollars implements IFinancialQuantity{

    /** cents
     *
     *  Stores the cents in an integer.
     *
     * @var int
     */
    private $cents;

    /** __construct
     *
     *  Construct a cents object passing in the number of cents as an integer.
     *
     * @param $dollars
     * @throws EInstantiationError
     */
    public function __construct($dollars){
        if (is_int($dollars)){
            $this->cents = $dollars * 100;
        }
        else if (is_float($dollars)){
            $this->cents = intval(round($dollars * 100));
        }
        else
        {
            throw new EInstantiationError(gettype($dollars));
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
     *  Returns TRUE if the dollars are equal.
     *
     * @param Dollars $cents
     * @return bool
     */
    public function equal(Dollars $cents){
        return $this->cents == $cents->asCentsInt();
    }

} 