<?php

namespace App\ValueObjects\Finance\Currency;

/**
 * Class Currency
 * @package Finance\Currency
 */
abstract class Currency{

    /** nameToString
     *
     *  Returns the string setName of the currency. For example, "Australian dollar".
     *
     * @return string
     */
    abstract public function nameToString();

    /** isoCode
     *
     *  Returns the ISO code of the currency. For example, "AUD".
     *
     * @return string
     */
    abstract public function isoCode();

    /** equals
     *
     *  Returns TRUE if the currency matches, FALSE otherwise.
     *
     * @param Currency $currency
     * @return bool
     */
    public function equals(Currency $currency){
        return $this->isoCode() === $currency->isoCode();
    }

}