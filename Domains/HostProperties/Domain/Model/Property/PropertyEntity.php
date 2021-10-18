<?php

namespace Domains\HostProperties\Domain\Model\Property;

use Common\ValueObjects\AggregateRoot;
use Common\ValueObjects\Identity\Identified;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyCheckinSuccessfullyCompleted;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyCheckoutSuccessfullyCompleted;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyCreated;

final class PropertyEntity extends AggregateRoot implements Property
{

    private Identified $identifier;

    private int $checkoutWhen;

    private int $checkinWhen;

    private Address $address;

    private Room $room;

    public function checkin(int $occurredOn): void
    {
        $this->checkinWhen = $occurredOn;
        //validations here
        $this->raise(new PropertyCheckinSuccessfullyCompleted($this));
    }

    public function checkout(int $occurredOn): void
    {
        $this->checkoutWhen = $occurredOn;
        //validations here
        $this->raise(new PropertyCheckoutSuccessfullyCompleted($this));
    }

    public function getIdentifier(): Identified
    {
        return $this->identifier;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function of(Identified $identifier, Address $address, Room $room): void
    {
        $this->identifier = $identifier;
        $this->address = $address;
        $this->room = $room;
        //Validations here as possible
    }

    public function fromExisting(Identified $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function createNew(): void
    {
        $this->raise(new PropertyCreated($this));
        //$this->raise(new PropertyRejected($this));
    }

    public function __toString(): string
    {
        return sprintf('Id %s Address %s Room %f', $this->identifier, $this->address, $this->room);
    }
}
