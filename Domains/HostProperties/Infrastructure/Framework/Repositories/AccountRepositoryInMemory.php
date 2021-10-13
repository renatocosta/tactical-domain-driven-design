<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use Domains\Context\BankAccount\Infrastructure\Framework\Entities\AccountModel;
use Illuminate\Contracts\Cache\Repository as Cache;

final class AccountRepositoryInMemory implements IAccountRepository 
{

    private IAccountRepository $accountRepository;

    private Cache $cache;

    public function __construct(IAccountRepository $accountRepository, Cache $cache)
    {
        $this->accountRepository = $accountRepository;
        $this->cache = $cache;
    }

    public function findAll(): array
    {
        return $this->cache->tags('acccounts')->remember('all', 60, function () {
            return $this->accountRepository->findAll();
        });
    }

    public function update(Account $account): void
    {

    }

    public function create(Account $account): void
    {
        $this->cache->tags('accounts')->flush();
        $this->accountRepository->create($account);
    }

    public function findById(int $accountId): Account
    {

    }

    public function countFor(Account $account): int
    {
        return 44;
    }
    
    public function findTransactions(int $accountid): array
    {

    }

}