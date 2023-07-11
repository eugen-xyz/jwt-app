<?php

namespace App\ValueObjects\Finance\FinancialYear;

/**
 * Class FinancialYear
 * @package DomainLayer\Finance\FinancialYear
 */
class FinancialYear {

    private $yearStart;

    private $yearEnd;

    public function __construct(\DateTime $date){
        $dayAndMonth = new \DateTime($date->format("j-F"));
        $financialYearStart = new \DateTime("01-July");

        if ($dayAndMonth < $financialYearStart) {
            $financialYearEnd = $date->format("Y");
        } else {
            $financialYearEnd = $date->modify("+1 year")->format("Y");
        }

        $this->yearEnd = new \DateTime("30 June " . $financialYearEnd);
        $this->yearStart = new \DateTime("1 July " . ($financialYearEnd - 1));
    }

    /** StartYear
     *
     *  Returns the
     *
     * @return mixed
     */
    public function getYearStart() {
        return $this->yearStart;
    }

    /** EndYear
     *
     *  Returns the
     *
     * @return mixed
     */
    public function getYearEnd() {
        return $this->yearEnd;
    }

}