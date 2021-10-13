<?php

namespace Domains\Context\BankAccount\Application\EventHandlers\Account;

use Domains\Context\BankAccount\Domain\Model\Account\AccountDebitPlaced;
use Domains\Context\BankAccount\Domain\Model\Account\AccountPlaced;
use Domains\Context\BankAccount\Domain\Model\Account\Specifications\InsufficientFundPolicy;
use Domains\CrossCutting\Domain\Application\Event\AbstractEvent;
use Domains\CrossCutting\Domain\Application\Event\DomainEventHandler;
use Illuminate\Support\Facades\Log;

final class AccountDebitPlacedEventHandler implements DomainEventHandler
{

    private InsufficientFundPolicy $insufficientFundPolicy;

    private IUnitOfWork $unitOfWork;

    public function __construct(InsufficientFundPolicy $insufficientFundPolicy, IUnitOfWork $unitOfWork)
    {
        $this->insufficientFundPolicy = $insufficientFundPolicy;
        $this->unitOfWork = $unitOfWork;
    }


    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
        if(!$this->insufficientFundPolicy->isValid($domainEvent)){
        //throw new InsufficientFundPolicyException 
        }
        $this->accountRepository->create($this->account);
        $this->unitOfWork->commit();
        
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof AccountDebitPlaced;
    }
}
