<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use CrossCutting\ValueObjects\Identity\Identified;
use Domains\CrossCutting\DataConsistency\Validatable;

interface Account extends Validatable
{

    public function createFrom(Identified $identifier, int $customerId, string $accountName, Balance $balance): Account;

    public function fromExisting(Identified $identifier, int $customerId, string $accountName, Balance $balance): Account;

    public function isEligible(): bool;

    public function getCustomerId(): int;

    public function getAccountName(): string;

    public function getBalance(): Balance;

    public function setId(int $id);

    public function getId(): int;
}
