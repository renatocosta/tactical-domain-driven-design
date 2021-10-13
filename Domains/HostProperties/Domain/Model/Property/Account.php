<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use CrossCutting\ValueObjects\Identity\Identified;
use CrossCutting\ValueObjects\Money\Money;

interface Account
{

    public function credit(Money $amount): void;

    public function debit(Money $amount): void;

    public function getCustomerId(): int;

    public function getAccountName(): string;

    public function getBalance(): Balance;

    public function getId(): Identified;

    public function createNew(Identified $identifier, int $customerId, string $accountName, Balance $balance): void;

    public function fromExisting(Identified $identifier, int $customerId, string $accountName, Balance $balance): void;

}
