<?php

namespace Domains\HostProperties\Application\EventHandlers\Property;

use CrossCutting\Domain\Application\Event\AbstractEvent;
use CrossCutting\Domain\Application\Event\DomainEventHandler;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyCheckinSuccessfullyCompleted;
use Illuminate\Support\Facades\Log;

final class PropertyCheckinSuccessfullyCompletedEventHandler implements DomainEventHandler
{

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof PropertyCheckinSuccessfullyCompleted;
    }
}
