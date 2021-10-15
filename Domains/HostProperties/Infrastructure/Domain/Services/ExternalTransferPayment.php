<?php

namespace Domains\HostProperties\Infrastructure\Domain\Services;

use Common\ValueObjects\Money\Money;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Services\PaymentTransferable;

final class ExternalTransferPayment implements PaymentTransferable
{

    public function perform(PaymentTransferable $transferPayment, Money $amount, Account $accountFrom, Account $accountTo): void
    {
    }
}
