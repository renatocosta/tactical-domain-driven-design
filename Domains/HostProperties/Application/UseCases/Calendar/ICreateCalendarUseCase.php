<?php

namespace Domains\HostProperties\Application\UseCases\Calendar;

interface ICreateCalendarUseCase
{

    public function execute(CreateCalendarInput $input): void;
}
