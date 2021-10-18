<?php

namespace Domains\HostProperties\Domain\Model\Calendar;

use Common\ValueObjects\Identity\Identified;

interface Calendar
{

    public function sync(): void;

    public function getIdentifier(): Identified;

    public function getPropertyId(): Identified;

    public function getCalendarUrl(): CalendarUrl;

    public function of(Identified $identifier, Identified $propertyId, CalendarUrl $calendarUrl): void;

    public function fromExisting(Identified $identifier): void;
 
    public function createNew(): void;
}
