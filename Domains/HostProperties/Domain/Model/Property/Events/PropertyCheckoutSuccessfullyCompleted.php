<?php

namespace Domains\HostProperties\Domain\Model\Property\Events;

use CrossCutting\Domain\Application\Event\AbstractEvent;
use Domains\HostProperties\Domain\Model\Property\Property;

class PropertyCheckoutSuccessfullyCompleted extends AbstractEvent
{

    public Property $property;

    public function __construct(Property $property)
    {
        parent::__construct();
        $this->property = $property;
    }
}
