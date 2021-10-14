<?php

namespace Domains\Context\BankAccount\Application\UseCases\Account;

use Domains\Context\BankAccount\Domain\Model\Account\IAccountRepository;

final class GetAllAccountsQuery implements IGetAccountsQuery
{

    private IAccountRepository $accountRepository;

    public function __construct(IAccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(): array
    {
        return $this->accountRepository->findAll();
    }
}
