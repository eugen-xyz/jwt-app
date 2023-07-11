<?php

namespace App\ValueObjects\Finance\Wallet\Wallet;

Use App\ValueObjects\Finance\Currency\Currency;
Use App\ValueObjects\Finance\FinancialQuantity\Cents\Cents;
Use App\ValueObjects\Finance\Money\Money\Money;
Use App\ValueObjects\Finance\Wallet\EInvalidCurrency;

/**
 * Class Wallet
 * @package Finance\Wallet\Wallet
 */
class Wallet {

    /** $deposits
     *
     *  Array of money to deposit.
     *
     * @var array of Money
     */
    private $deposits = [];

    /** $withdrawals
     *
     *  Array of money to withdraw.
     *
     * @var array of Money
     */
    private $withdrawals = [];

    /** $currency
     *
     *  Currency of the wallet.
     *
     * @var \App\ValueObjects\Finance\Currency\Currency
     */
    private $currency;

    /** __construct
     *
     *  Constructor.
     *
     * @param Currency $currency
     */
    public function __construct(Currency $currency){
        $this->currency = $currency;
    }

    /** addMoney
     *
     *  Deposit money to the wallet.
     *
     * @param Money $money
     * @throws \DomainLayer\Finance\Wallet\EInvalidCurrency
     */
    public function deposit(Money $money){
        if (!$money->currency()->equals($this->currency)){
            throw new EInvalidCurrency($this->currency->nameToString());
        }
        $this->deposits[] = $money;
    }

    /** withdrawMoney
     *
     *  Withdraw money from the wallet
     * 
     * @param Money $money
     * @throws \DomainLayer\Finance\Wallet\EInvalidCurrency
     */
    public function withdraw(Money $money){
        if (!$money->currency()->equals($this->currency)){
            throw new EInvalidCurrency($this->currency->nameToString());
        }
        $this->withdrawals[] = $money;
    }

    /** balance
     *
     *  Returns the balance of the wallet.
     *
     * @return Money
     */
    public function balance(){
        $money = new Money(new Cents(0), $this->currency);
        foreach($this->deposits as $deposit){
            /** @var \App\ValueObjects\Finance\Money\Money\Money $money */
            $money = $money->addMoney($deposit);
        }

        foreach($this->withdrawals as $withdrawal){
            /** @var \App\ValueObjects\Finance\Money\Money\Money $money */
            $money = $money->subtractMoney($withdrawal);
        }

        return $money;
    }

    /** transactionCount
     *
     *  Returns the number of transactions.
     *
     * @return int
     */
    public function transactionCount(){
        return count($this->deposits) + count($this->withdrawals);
    }
}