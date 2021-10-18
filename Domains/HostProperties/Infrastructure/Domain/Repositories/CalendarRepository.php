<?php

namespace Domains\HostProperties\Infrastructure\Domain\Repositories;

use Common\ValueObjects\Identity\Identified;
use Domains\HostProperties\Domain\Model\Calendar\Calendar;
use Domains\HostProperties\Domain\Model\Calendar\ICalendarRepository;
use Domains\HostProperties\Infrastructure\Framework\Entities\CalendarModel;

final class CalendarRepository implements ICalendarRepository
{

    private CalendarModel $model;

    public function __construct(CalendarModel $model)
    {
        $this->model = $model;
    }
    
    public function findAll(): array
    {
        return $this->model
            ->select('id', 'url')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function update(Calendar $calendar): void
    {

    }

    public function create(Calendar $calendar): void
    {

    }

    public function createCalendarTo(Identified $identifier): void
    {

    }
    
    public function findById(Identified $identifier): Calendar
    {

    }

    public function countFor(Calendar $calendar): int
    {

    }

}