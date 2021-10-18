<?php

namespace Domains\HostProperties\Domain\Model\Calendar;

use Common\ValueObjects\AggregateRoot;
use Common\ValueObjects\Identity\Identified;
use Domains\HostProperties\Domain\Model\Calendar\Events\CalendarCreated;

final class CalendarEntity extends AggregateRoot implements Calendar
{

    private Identified $identifier;

    private Identified $propertyId;

    private CalendarUrl $calendarUrl;

    public function sync(): void
    {
    }

    public function getIdentifier(): Identified
    {
        return $this->identifier;
    }

    public function getPropertyId(): Identified
    {
        return $this->propertyId;
    }

    public function getCalendarUrl(): CalendarUrl
    {
        return $this->calendarUrl;
    }

    public function of(Identified $identifier, Identified $propertyId, CalendarUrl $calendarUrl): void
    {
        $this->identifier = $identifier;
        $this->propertyId = $propertyId;
        $this->calendarUrl = $calendarUrl;
    }

    public function fromExisting(Identified $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function createNew(): void
    {
        $this->raise(new CalendarCreated($this));
    }

    public function __toString(): string
    {
        return sprintf('Id %s Propert Id %s Calendar url %f', $this->identifier, $this->propertId, $this->calendarUrl);
    }
}
