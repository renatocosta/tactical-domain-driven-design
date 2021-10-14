<?php

namespace Domains\HostProperties\Application\UseCases\Property;

interface ICreatePropertyUseCase
{

    public function execute(CreatePropertyInput $input): void;
}
