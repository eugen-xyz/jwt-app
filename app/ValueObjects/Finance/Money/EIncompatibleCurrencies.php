<?php

namespace App\ValueObjects\Finance\Money;

/**
 * Class EIncompatibleCurrencies
 */
class EIncompatibleCurrencies extends \Exception{

    /** __construct
     *
     *  Class constructor.
     *
     */
    public function __construct(){
        parent::__construct("Cannot perform operation between monies as their currencies are different.");
    }
} 