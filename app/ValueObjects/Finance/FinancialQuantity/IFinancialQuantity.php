<?php

namespace App\ValueObjects\Finance\FinancialQuantity;

/**
 * Interface IFinancialQuantity
 * @package FinancialQuantity
 */
interface IFinancialQuantity {

    /** asInteger
     *
     *  Returns the value of this quantity in cents.
     *
     * @return integer
     */
    public function asCentsInt();

    /** __constructor.
     *
     *  Class constructor.
     *
     * @param $param
     * @throws EInstantiationError
     */
    public function __construct($param);

} 