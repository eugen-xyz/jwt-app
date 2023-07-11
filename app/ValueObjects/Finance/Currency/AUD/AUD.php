<?php

namespace App\ValueObjects\Finance\Currency\AUD;

Use App\ValueObjects\Finance\Currency\Currency;

/**
 * Class AUD
 * @package Currency
 */
class AUD extends Currency{

    /** nameToString
     *
     *  Returns the string setName of the currency.
     *
     * @return string
     */
    public function nameToString(){
        return "Australian dollar";
    }

    /** isoCode
     *
     *  Returns the ISO code of the currency.
     *
     * @return string
     */
    public function isoCode(){
        return "AUD";
    }

}