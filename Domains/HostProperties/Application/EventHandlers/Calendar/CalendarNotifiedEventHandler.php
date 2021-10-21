<?php

namespace Domains\HostProperties\Application\EventHandlers\Calendar;

use Common\Application\Event\AbstractEvent;
use Common\Application\Event\DomainEventHandler;
use Domains\HostProperties\Domain\Model\Calendar\Events\CalendarCreated;
use Illuminate\Support\Facades\Log;

final class CalendarNotifiedEventHandler implements DomainEventHandler
{

    public function handle(AbstractEvent $domainEvent): void
    {
        //MixPanel::event('Create');
        //$this->calendarRepository->delete($domainEvent->calendar);
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof CalendarCreated;
    }
}
