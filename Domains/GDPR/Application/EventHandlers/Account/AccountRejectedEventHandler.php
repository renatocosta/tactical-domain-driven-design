<?php

namespace Domains\Context\BankAccount\Application\EventHandlers\Account;

use Domains\Context\BankAccount\Domain\Model\Account\AccountRejected;
use Domains\CrossCutting\Domain\Application\Event\AbstractEvent;
use Domains\CrossCutting\Domain\Application\Event\DomainEventHandler;
use Illuminate\Support\Facades\Log;

final class AccountRejectedEventHandler implements DomainEventHandler
{

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof AccountRejected;
    }
}
