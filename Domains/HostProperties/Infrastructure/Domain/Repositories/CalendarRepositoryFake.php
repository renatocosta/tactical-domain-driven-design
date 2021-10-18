<?php

namespace Domains\HostProperties\Infrastructure\Domain\Repositories;

use Common\ValueObjects\Identity\Guid;
use Common\ValueObjects\Identity\Identified;
use Domains\HostProperties\Domain\Model\Calendar\Calendar;
use Domains\HostProperties\Domain\Model\Calendar\CalendarUrl;
use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;
use Ramsey\Uuid\Uuid;

final class CalendarRepositoryFake implements ICalendarRepository
{

    private Calendar $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function findAll(): array
    {
        $url = new CalendarUrl('https://www.icalendar.com');
        $this->calendar->of(Guid::from(Uuid::uuid4()), Guid::from(Uuid::uuid4()), $url);
        $calendar2 = $this->calendar;
        $calendar2->of(Guid::from(Uuid::uuid4()), Guid::from(Uuid::uuid4()), $url);
        return [$this->calendar, $calendar2];
    }

    public function update(Calendar $calendar): void
    {
    }

    public function create(Calendar $calendar): void
    {
    }

    public function findById(Identified $identifier): Calendar
    {
        $this->calendar->fromExisting($identifier);
        return $this->calendar;
    }

    public function createCalendarTo(Identified $identifier): void
    {
        //$this->calendar->
    }

    public function countFor(Calendar $calendar): int
    {
        return 0;
    }
}
