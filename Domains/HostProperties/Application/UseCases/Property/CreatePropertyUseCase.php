<?php

namespace Domains\Context\BankAccount\Application\UseCases\Account;

use CrossCutting\ValueObjects\Identity\Guid;
use Domains\HostProperties\Application\UseCases\Property\CreatePropertyInput;
use Domains\HostProperties\Application\UseCases\Property\ICreatePropertyUseCase;
use Domains\HostProperties\Domain\Model\Property\Address;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\Room;

final class CreatePropertyUseCase implements ICreatePropertyUseCase
{

    public Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function execute(CreatePropertyInput $input): void
    {
        $address = new Address($input->street, $input->city, $input->state, $input->country, $input->zipcode);
        $room = new Room($input->roomWidth, $input->roomHeight);
        $this->property->createNew(Guid::from('123e4567-e89b-12d3-a456-556642440000'), $address, $room);
    }
}
