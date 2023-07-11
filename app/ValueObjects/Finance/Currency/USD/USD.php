<?php

namespace App\ValueObjects\Finance\Currency\USD;

Use App\ValueObjects\Finance\Currency\Currency;

/**
 * Class USD
 * @package Currency
 */
class USD extends Currency{

    /** nameToString
     *
     *  Returns the string setName of the currency.
     *
     * @return string
     */
    public function nameToString(){
        return "American dollar";
    }

    /** isoCode
     *
     *  Returns the ISO code of the currency.
     *
     * @return string
     */
    public function isoCode(){
        return "USD";
    }

}