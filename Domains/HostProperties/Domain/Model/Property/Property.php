<?php

namespace Domains\HostProperties\Domain\Model\Property;

use Common\ValueObjects\Identity\Identified;

interface Property
{

    public function checkin(int $occurredOn): void;

    public function checkout(int $occurredOn): void;

    public function getIdentifier(): Identified;

    public function getAddress(): Address;

    public function getRoom(): Room;

    public function createNew(): void;

    public function fromExisting(Identified $identifier): void;

    public function of(Identified $identifier, Address $address, Room $room): void;

}
