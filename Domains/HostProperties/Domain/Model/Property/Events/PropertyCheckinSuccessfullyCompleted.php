<?php

namespace Domains\HostProperties\Domain\Model\Property\Events;

use Common\Application\Event\AbstractEvent;
use Domains\HostProperties\Domain\Model\Property\Property;

class PropertyCheckinSuccessfullyCompleted extends AbstractEvent
{

    public Property $property;

    public function __construct(Property $property)
    {
        parent::__construct();
        $this->property = $property;
    }
}
