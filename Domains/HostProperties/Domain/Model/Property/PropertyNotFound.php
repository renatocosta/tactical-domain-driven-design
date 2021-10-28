<?php

namespace Domains\HostProperties\Domain\Model\Property;

use BadMethodCallException;
use Common\ValueObjects\Identity\Identified;
use Domains\HostProperties\Domain\Model\Property\Property;

final class PropertyNotFound implements Property
{

    public function checkin(int $occurredOn): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function checkout(int $occurredOn): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getIdentifier(): Identified
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getAddress(): Address
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function getRoom(): Room
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function createNew(): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function fromExisting(Identified $identifier): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    public function of(Identified $identifier, Address $address, Room $room): void
    {
        throw new BadMethodCallException('Not implemented');
    }
}
