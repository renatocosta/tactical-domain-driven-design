<?php

namespace Domains\HostProperties\Application\UseCases\Property;

use Common\ValueObjects\Identity\Guid;
use Domains\HostProperties\Application\UseCases\Property\CreatePropertyInput;
use Domains\HostProperties\Application\UseCases\Property\ICreatePropertyUseCase;
use Domains\HostProperties\Domain\Model\Property\Address;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\Room;
use Domains\HostProperties\Domain\Model\Property\Specifications\PropertyRoomDiscountBetweenSpecification;
use Ramsey\Uuid\Uuid;

final class CreatePropertyUseCase implements ICreatePropertyUseCase
{

    public Property $property;

    private PropertyRoomDiscountBetweenSpecification $propertyRoomDiscountBetweenSpecification;

    public function __construct(Property $property, PropertyRoomDiscountBetweenSpecification $propertyRoomDiscountBetweenSpecification)
    {
        $this->property = $property;
        $this->propertyRoomDiscountBetweenSpecification = $propertyRoomDiscountBetweenSpecification;
    }

    public function execute(CreatePropertyInput $input): void
    {
        $address = new Address($input->street, $input->city, $input->state, $input->country, $input->zipcode);
        $room = new Room($input->roomWidth, $input->roomHeight);
        $this->property->of(Guid::from(Uuid::uuid4()), $address, $room);

        if ($this->propertyRoomDiscountBetweenSpecification->isSatisfiedBy($this->property)) {
            //    $this->property->setDiscount(true);
        }
        $this->property->createNew();
    }
}
