<?php

namespace Domains\HostProperties\Infrastructure\Domain\Repositories;

use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Infrastructure\Framework\Entities\PropertyModel;

final class PropertyRepository implements IPropertyRepository 
{

    private PropertyModel $model;

    public function __construct(PropertyModel $model)
    {
        $this->model = $model;
    }
    
    public function findAll(): array
    {
        return $this->model
            ->select('id', 'street', 'city', 'state')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function update(Property $property): void
    {

    }

    public function create(Property $property): void
    {

    }

    public function findById(int $propertyId): Property
    {

    }

    public function countFor(Property $property): int
    {

    }

}