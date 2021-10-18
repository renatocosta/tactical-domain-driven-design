<?php

namespace Domains\HostProperties\Domain\Model\Calendar;

use BadMethodCallException;
use Common\ValueObjects\Identity\Identified;

final class CalendarNotFound implements Calendar
{

    public function sync(): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getIdentifier(): Identified
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getPropertyId(): Identified
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getCalendarUrl(): CalendarUrl
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function createNew(): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function of(Identified $identifier, Identified $propertyId, CalendarUrl $calendarUrl): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function fromExisting(Identified $identifier): void
    {
        throw new BadMethodCallException('Not implemented');
    }

}
