<?php

namespace Domains\Context\BankAccount\Application\EventHandlers\Account;

use Domains\Context\BankAccount\Domain\Model\Account\AccountDebitPlaced;
use Domains\Context\BankAccount\Domain\Model\Account\AccountPlaced;
use Domains\CrossCutting\Domain\Application\Event\AbstractEvent;
use Domains\CrossCutting\Domain\Application\Event\DomainEventHandler;
use Illuminate\Support\Facades\Log;

final class AccountDebitPlacedNotificationEventHandler implements Domains\Context\BankAccount\Application\EventHandlers\Account\DomainEventHandler
{

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
        //Policy for dealing with users simultaneously
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof AccountDebitPlaced;
    }
}
