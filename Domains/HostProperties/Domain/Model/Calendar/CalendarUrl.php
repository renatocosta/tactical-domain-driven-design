<?php

namespace Domains\HostProperties\Domain\Model\Calendar;

use Assert\Assert;
use Assert\AssertionFailedException;
use Common\ValueObjects\ValueObject;

final class CalendarUrl implements ValueObject
{

    public string $url;

    public function __construct(string $url)
    {
        try {
            Assert::that($url)->notEmpty()->url();
        } catch (AssertionFailedException $e) {
            throw new CalendarException($e->getMessage());
        }

        $this->url = $url;
    }

    public function isSame(ValueObject $url): bool
    {

        if (!$url instanceof self) {
            return false;
        }

        return $this->url === $url->url;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
