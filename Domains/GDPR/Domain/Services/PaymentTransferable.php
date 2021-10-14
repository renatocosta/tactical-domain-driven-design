<?php

namespace Domains\Context\BankAccount\Domain\Services;

use CrossCutting\ValueObjects\Money\Money;
use Domains\Context\BankAccount\Domain\Model\Account\Account;

interface PaymentTransferable
{

    public function perform(PaymentTransferable $transferPayment, Money $amount, Account $accountFrom, Account $accountTo): void;

}
