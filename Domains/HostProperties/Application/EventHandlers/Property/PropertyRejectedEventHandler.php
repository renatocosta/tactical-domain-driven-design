<?php

namespace Domains\HostProperties\Application\EventHandlers\Property;

use Common\Application\Event\AbstractEvent;
use Common\Application\Event\DomainEventHandler;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyRejected;
use Illuminate\Support\Facades\Log;

final class PropertyRejectedEventHandler implements DomainEventHandler
{

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof PropertyRejected;
    }
}
