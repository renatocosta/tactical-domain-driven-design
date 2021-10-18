<?php

namespace Domains\HostProperties\Application\EventHandlers\Calendar;

use Common\Application\Event\AbstractEvent;
use Common\Application\Event\DomainEventHandler;
use Domains\HostProperties\Domain\Model\Calendar\Events\CalendarRejected;
use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;
use Illuminate\Support\Facades\Log;

final class CalendarRejectedEventHandler implements DomainEventHandler
{

    private ICalendarRepository $calendarRepository;

    public function __construct(ICalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function handle(AbstractEvent $domainEvent): void
    {
        //$this->calendarRepository->delete($domainEvent->calendar);
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof CalendarRejected;
    }
}
