<?php

namespace Domains\HostProperties\Domain\Model\Calendar\Events;

use Common\Application\Event\AbstractEvent;
use Domains\HostProperties\Domain\Model\Calendar\Calendar;

class CalendarRejected extends AbstractEvent
{

    public Calendar $calendar;

    public function __construct(Calendar $calendar)
    {
        parent::__construct();
        $this->calendar = $calendar;
    }
}
