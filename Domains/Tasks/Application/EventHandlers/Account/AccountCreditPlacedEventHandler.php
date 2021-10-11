<?php

namespace Domains\Context\BankAccount\Application\EventHandlers\Account;

use Domains\Context\BankAccount\Domain\Model\Account\AccountCreated;
use Domains\Context\BankAccount\Domain\Model\Account\AccountPlaced;
use Domains\CrossCutting\Domain\Application\Event\AbstractEvent;
use Domains\CrossCutting\Domain\Application\Event\DomainEventHandler;
use Illuminate\Support\Facades\Log;

final class AccountCreditPlacedEventHandler implements DomainEventHandler
{

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof AccountPlaced;
    }
}
