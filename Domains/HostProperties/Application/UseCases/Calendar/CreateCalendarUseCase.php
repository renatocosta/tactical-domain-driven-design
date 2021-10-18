<?php

namespace Domains\HostProperties\Application\UseCases\Calendar;

use Common\ValueObjects\Identity\Guid;
use Domains\HostProperties\Domain\Model\Calendar\Calendar;
use Domains\HostProperties\Domain\Model\Calendar\CalendarUrl;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Services\PropertyCalendarManageable;
use Ramsey\Uuid\Uuid;

final class CreateCalendarUseCase implements ICreateCalendarUseCase
{

    public Calendar $calendar;

    private Property $property;

    private PropertyCalendarManageable $propertyCalendarManager;

    public function __construct(Calendar $calendar, Property $property, PropertyCalendarManageable $propertyCalendarManager)
    {
        $this->calendar = $calendar;
        $this->propertyCalendarManager = $propertyCalendarManager;
        $this->property = $property;
    }

    public function execute(CreateCalendarInput $input): void
    {
        $this->calendar->of(Guid::from(Uuid::uuid4()), Guid::from($input->propertyId), new CalendarUrl($input->url));
        $this->calendar->createNew();
        $this->property->fromExisting(Guid::from($input->propertyId));
        $this->propertyCalendarManager->addCalendarTo($this->property);
    }
}
