<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

interface IAccountRepository
{

    public function findAll(): array;

    public function update(Account $account): void;

    public function create(Account $account): void;

    public function findById(int $accountId): Account;

    public function countFor(Account $account): int;

    public function findTransactions(int $accountid): array;

}
