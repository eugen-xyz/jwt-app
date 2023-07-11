<?php

namespace App\ValueObjects\Finance\Money;

/**
 * Class EAllocationsNotAccurate
 */
class EAllocationsNotAccurate extends \Exception{

    /** __construct
     *
     *  Class constructor.
     *
     */
    public function __construct(){
        parent::__construct("Allocation distribution must be float or integral and add to 100.");
    }
} 