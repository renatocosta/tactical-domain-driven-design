<?php

namespace Domains\HostProperties\Domain\Model\Property;

interface IPropertyRepository
{

    public function findAll(): array;

    public function update(Property $property): void;

    public function create(Property $property): void;

    public function findById(int $propertyId): Property;

    public function countFor(Property $property): int;
}
