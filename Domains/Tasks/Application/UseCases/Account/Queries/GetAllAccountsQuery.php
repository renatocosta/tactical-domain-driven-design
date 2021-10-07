<?php

namespace Domains\Context\BankAccount\Application\UseCases\Account;

use Common\CrossCuttingConcerns\DataConsistency\IUnitOfWork;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\Balance;
use Domains\Context\BankAccount\Domain\Model\Account\IAccountRepository;
use Illuminate\Support\Facades\Log;
use Exception;

final class GetAllAccountsQuery implements ICreateAccountUseCase
{

    public Account $account;

    private IAccountRepository $accountRepository;

    private IUnitOfWork $unitOfWork;

    public function __construct(Account $account, IAccountRepository $accountRepository, IUnitOfWork $unitOfWork)
    {
        $this->account = $account;
        $this->accountRepository = $accountRepository;
        $this->unitOfWork = $unitOfWork;
    }

    public function execute(CreateAccountInput $input): void
    {
       // $this->account->createFrom($input->customerId, $input->accountName, new Balance($input->currentBalance));

    }
}
