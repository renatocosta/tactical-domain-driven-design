<?php

namespace Domains\Context\BankAccount\Domain\Services;

use CrossCutting\ValueObjects\Money\Money;
use Domains\Context\BankAccount\Domain\Model\Account\Account;

final class TransferPayment implements PaymentTransferable
{

    public function perform(PaymentTransferable $transferPayment, Money $amount, Account $accountFrom, Account $accountTo): void
    {
    }
}
