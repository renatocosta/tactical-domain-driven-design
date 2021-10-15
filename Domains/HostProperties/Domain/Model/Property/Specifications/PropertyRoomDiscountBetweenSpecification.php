<?php

namespace Domains\HostProperties\Domain\Model\Property\Specifications;

use Common\Specification\CompositeSpecification;
use Domains\HostProperties\Domain\Model\Property\Property;

final class PropertyRoomDiscountBetweenSpecification extends CompositeSpecification
{

    private int $min;

    private int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param Property $property
     * @return bool
     */
    public function isSatisfiedBy($property): bool
    {
        return $property->getRoom()->width > $this->min && $property->getRoom()->width < $this->max;
    }
}
