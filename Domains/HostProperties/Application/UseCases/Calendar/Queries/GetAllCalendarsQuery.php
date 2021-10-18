<?php

namespace Domains\HostProperties\Application\UseCases\Calendar\Queries;

use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;

final class GetAllCalendarsQuery implements IGetCalendarQuery
{

    private ICalendarRepository $calendarRepository;

    public function __construct(ICalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }

    public function execute(): array
    {
        return $this->calendarRepository->findAll();
    }
}
