<?php

namespace App\ValueObjects\Finance\Money;

/**
 * Class EValueNotAllowed
 */
class EValueNotAllowed extends \Exception{

    /** __construct
     *
     *  Class constructor.
     *
     */
    public function __construct(){
        parent::__construct("That given value is not allowed for this operation.");
    }
} 