<?php

namespace Domains\Context\BankAccount\Domain\Model\Account\Specifications;

use CrossCutting\Domain\Model\Specification\CompositeSpecification;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\AccountNotFound;
use Domains\Context\BankAccount\Domain\Model\Account\IAccountRepository;

final class AccountIsAtTheBeginningOfPeriodSpecification extends CompositeSpecification
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
    public function isSatisfiedBy($account): bool
    {
        
        return !$this->accountRepository->findById($account->getId()) instanceof AccountNotFound;
    }
}
