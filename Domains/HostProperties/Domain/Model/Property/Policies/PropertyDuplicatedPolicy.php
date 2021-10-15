<?php

namespace Domains\HostProperties\Domain\Model\Property\Policies;

use Common\Policy\IPolicy;
use Domains\HostProperties\Domain\Model\Property\Property;

class PropertyDuplicatedPolicy implements IPolicy
{

    private Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function isValid($propertyRepository): bool
    {
        return true;
        //return $propertyRepository->countFor($this->property) > 1;
    }
}
