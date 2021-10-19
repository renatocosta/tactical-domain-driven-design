<?php

namespace Domains\HostProperties\Application\EventHandlers\Calendar;

use Common\Application\Event\AbstractEvent;
use Common\Application\Event\DomainEventHandler;
use Common\DataConsistency\IUnitOfWork;
use Domains\HostProperties\Domain\Model\Calendar\Events\CalendarRejected;
use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Illuminate\Support\Facades\Log;

final class CalendarRejectedEventHandler implements DomainEventHandler
{

    private ICalendarRepository $calendarRepository;

    private IUnitOfWork $unitOfWork;

    public function __construct(ICalendarRepository $calendarRepository, IUnitOfWork $unitOfWork)
    {
        $this->calendarRepository = $calendarRepository;
        $this->unitOfWork = $unitOfWork;
    }

    public function handle(AbstractEvent $domainEvent): void
    {
        $this->unitOfWork->rollback();
        throw new PropertyException('Something went wrong while validating a Calendar');
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof CalendarRejected;
    }
}
