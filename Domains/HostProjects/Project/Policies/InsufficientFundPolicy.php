<?php

namespace Domains\Context\BankAccount\Domain\Model\Account\Specifications;

use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\IAccountRepository;

final class InsufficientFundPolicy
{

    private IAccountRepository $accountRepository;

    public function __construct(IAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @param Account $account
     * @return bool
     */
    public function isValid($account): bool
    {
        return $this->accountRepository->countFor($account) > 0;
    }
}
