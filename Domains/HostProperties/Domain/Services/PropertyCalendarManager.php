<?php

namespace Domains\HostProperties\Domain\Services;

use Domains\HostProperties\Domain\Model\Calendar\Calendar;
use Domains\HostProperties\Domain\Model\Calendar\CalendarException;
use Domains\HostProperties\Domain\Model\Calendar\CalendarNotFound;
use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;
use Domains\HostProperties\Domain\Model\Property\Property;

final class PropertyCalendarManager implements PropertyCalendarManageable
{

    private Calendar $calendar;

    private ICalendarRepository $calendarRepository;

    public function __construct(Calendar $calendar, ICalendarRepository $calendarRepository)
    {
        $this->calendar = $calendar;
        $this->calendarRepository = $calendarRepository;
    }

    public function addCalendarTo(Property $property): void
    {
        $result = $this->calendarRepository->findById($this->calendar->getIdentifier());
        if ($result instanceof CalendarNotFound) throw new CalendarException('No such calendar!');
        $this->calendarRepository->createCalendarTo($property->getIdentifier());
    }
}
