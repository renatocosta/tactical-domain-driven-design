<?php

namespace Domains\HostProperties\Domain\Model\Property;

use Assert\Assert;
use CrossCutting\ValueObjects\ValueObject;

final class Address implements ValueObject
{

    public string $street;

    public string $city;

    public string $state;

    public string $country;

    public string $zipcode;

    public function __construct(string $street, string $city, string $state, string $country, string $zipcode)
    {
        Assert::lazy()
            ->that($street)->notEmpty()->length(200)
            ->that($city)->notEmpty()->length(100)
            ->that($state)->notEmpty()->length(2)
            ->that($country)->notEmpty()->length(100)
            ->that($zipcode)->notEmpty()->length(8)->regex("/\b[A-Z]{2}\s+\d{5}(-\d{4})?\b/")
            ->verifyNow();

        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zipcode = $zipcode;
    }

    public function isSame(ValueObject $address): bool
    {

        if (!$address instanceof self) {
            return false;
        }

        return $this->toNative() === $address->toNative();
    }

    public static function fromNative(array $native): self
    {
        return new self($native['street'], $native['city'], $native['state'], $native['country'], $native['zipcode']);
    }

    public function toNative(): array
    {
        return ['street' => $this->street, 'city' => $this->city, 'state' => $this->state, 'country' => $this->country, 'zipcode' => $this->zipcode];
    }

    public function __toString(): string
    {
        return sprintf('street %s city %s state %s country %s zipcode %s', $this->street, $this->city, $this->state, $this->country, $this->zipcode);
    }
}
