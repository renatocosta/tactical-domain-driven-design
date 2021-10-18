<?php

namespace Domains\HostProperties\Application\UseCases\Calendar;

final class CreateCalendarInput
{

    public string $url;

    public string $propertyId;

    public function __construct(string $url, string $propertyId)
    {
        $this->url = $url;
        $this->propertyId = $propertyId;
    }
}
