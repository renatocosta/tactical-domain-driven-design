<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use Assert\Assert;
use Assert\AssertionFailedException;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\Balance;

final class AccountNotFound implements Account
{

    public function createFrom(int $customerId, string $accountName, Balance $balance): Account
    {
        //Not implemented
        return $this;
    }

    public function isEligible(): bool
    {
        return false;
    }

    public function readFrom(int $id, int $customerId, string $accountName, Balance $balance): Account
    {
        //Not implemented
        return $this;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function getBalance(): Balance
    {
        return $this->balance;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function __toString(): string
    {
        return sprintf('Customer Id %s Customer name %s Balance %f', $this->customerId, $this->accountName, $this->balance->value);
    }
}
