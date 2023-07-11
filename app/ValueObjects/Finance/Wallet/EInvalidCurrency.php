<?php

namespace App\ValueObjects\Finance\Wallet;

/**
 * Class EInvalidCurrency
 * @package Finance\Wallet
 */
class EInvalidCurrency extends \Exception{

    /** __construct
     *
     *  Constructor.
     *
     * @param string $currency
     */
    public function __construct($currency){
        parent::__construct("This wallet only accepts money with the currency of '$currency'.");
    }

} 