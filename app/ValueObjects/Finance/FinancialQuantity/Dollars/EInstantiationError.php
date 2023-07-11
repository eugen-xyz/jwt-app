<?php

namespace App\ValueObjects\Finance\FinancialQuantity\Dollars;

/**
 * Class EInstantiationError
 * @package FinancialQuantity\Cents
 */
class EInstantiationError extends \Exception{

    /** __construct
     *
     *  Class constructor.
     *
     */
    public function __construct($type){
        parent::__construct("Value provided to this class was of type '$type' and must be an integer or float.");
    }

} 