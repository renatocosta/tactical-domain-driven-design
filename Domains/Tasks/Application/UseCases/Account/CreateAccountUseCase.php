<?php

namespace Domains\Context\BankAccount\Application\UseCases\Account;

use Common\CrossCuttingConcerns\DataConsistency\IUnitOfWork;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\Balance;
use Domains\Context\BankAccount\Domain\Model\Account\IAccountRepository;
use Domains\Context\BankAccount\Infrastructure\Framework\DataAccess\UnitOfWork;
use Illuminate\Support\Facades\Log;
use Exception;

final class CreateAccountUseCase implements ICreateAccountUseCase
{

    public $account;

    private $accountRepository;

    private IUnitOfWork $unitOfWork;

    public function __construct(Account $account, IAccountRepository $accountRepository, IUnitOfWork $unitOfWork)
    {
        $this->account = $account;
        $this->accountRepository = $accountRepository;
        $this->unitOfWork = $unitOfWork;
    }

    public function execute(CreateAccountInput $input): void
    {
        $this->account->createFrom($input->customerId, $input->accountName, new Balance($input->currentBalance));
        if (!$this->account->isValid()) {
            $input->modelState->addErrors($this->account->getErrors());
            return;
        }

        try {
            $this->accountRepository->create($this->account);
            $this->unitOfWork->commit();
        } catch (Exception $e) {
            $input->modelState->addError('Something went wrong while creating a new account');
            $this->unitOfWork->rollback();
        }
    }
}
