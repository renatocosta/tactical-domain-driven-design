<?php

namespace Domains\Context\BankAccount\Infrastructure\Domain\Repositories;

final class AccountRepository implements IAccountRepository 
{

    private AccountModel $model;

    public function __construct(AccountModel $model)
    {
        $this->model = $model;
    }

    public function findAll(): array
    {

    }

    public function update(Account $account): void
    {

    }

    public function create(Account $account): void
    {

    }

    public function findById(int $accountId): Account
    {

    }

    public function findTransactions(int $accountid): array
    {

    }

}