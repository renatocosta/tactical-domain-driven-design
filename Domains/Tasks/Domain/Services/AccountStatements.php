<?php

namespace Domains\Context\BankAccount\Domain\Services;

interface AccountStatements
{

    public function fetchAccountsForSpecification(PaymentTransferable $transferPayment): void;

}
