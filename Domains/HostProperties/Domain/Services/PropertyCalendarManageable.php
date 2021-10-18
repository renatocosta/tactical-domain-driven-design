<?php

namespace Domains\HostProperties\Domain\Services;

use Domains\HostProperties\Domain\Model\Property\Property;

interface PropertyCalendarManageable
{

    public function addCalendarTo(Property $property): void;
}
