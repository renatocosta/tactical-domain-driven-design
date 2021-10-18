<?php

namespace Domains\HostProperties\Domain\Model\Calendar;

use Common\ValueObjects\Identity\Identified;

interface ICalendarRepository
{

    public function findAll(): array;

    public function update(Calendar $calendar): void;

    public function create(Calendar $calendar): void;

    public function createCalendarTo(Identified $identifier): void;

    public function findById(Identified $identifier): Calendar;

    public function countFor(Calendar $calendar): int;
}
