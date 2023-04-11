<?php

namespace App\Traits;

trait SqlTrait
{
    /**
     * Returns query for an outstanding or current loan.
     * If principal balance is greater than 0 then loan is still outstanding
     * This is got by subtracting the disbursed amount from payments made against the loan
     * 
     * @param boolean $alias
     */
    public function outstandingSql($alias = false): string
    {
        $sql = "(loans.amount - abs((select IFNULL(sum(debit_credit_amount), 0) from loan_ledger as l where l.loan_id = loans.id)))";
        $sql .= $alias ? " as outstanding_amount" : "  > 0";
        return $sql;
    }
}
