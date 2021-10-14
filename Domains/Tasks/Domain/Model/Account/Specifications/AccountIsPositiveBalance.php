<?php

namespace Domains\Context\BankAccount\Domain\Model\Account\Specifications;

use CrossCutting\Domain\Model\Specification\CompositeSpecification;
use Domains\Context\BankAccount\Domain\Model\Account\Account;

final class AccountIsPositiveBalance extends CompositeSpecification
{

    /**
     * @param Account $account
     * @return bool
     */
    public function isSatisfiedBy($account): bool
    {
        
        return $account->getBalance()->value > 10;
    }
}
