<?php

namespace Domains\HostProperties\Application\UseCases\Property;

final class CreatePropertyInput
{

    public string $street;

    public string $city;

    public string $state;

    public string $country;

    public string $zipcode;

    public int $roomWidth;

    public int $roomHeight;

    public function __construct(string $street, string $city, string $state, string $country, string $zipcode, int $roomWidth, int $roomHeight)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zipcode = $zipcode;
        $this->roomWidth = $roomWidth;
        $this->roomHeight = $roomHeight;
    }
}
