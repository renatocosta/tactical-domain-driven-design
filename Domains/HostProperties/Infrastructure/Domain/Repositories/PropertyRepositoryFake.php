<?php

namespace Domains\HostProperties\Infrastructure\Domain\Repositories;

use Common\ValueObjects\Identity\Guid;
use Domains\HostProperties\Domain\Model\Property\Address;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\Room;
use Ramsey\Uuid\Uuid;

final class PropertyRepositoryFake implements IPropertyRepository
{

    private Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function findAll(): array
    {
        $address = new Address('Av ahg', 'Miami', 'Florida', 'USA', '08787322');
        $room = new Room(128, 221);
        $address2 = new Address('Av jkl', 'San Francisco', 'California', 'USA', '32287438');
        $this->property->of(Guid::from(Uuid::uuid4()), $address, $room);
        $property2 = $this->property;
        $property2->of(Guid::from(Uuid::uuid4()), $address2, $room);
        return [$this->property, $property2];
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
        return 0;
    }
}
