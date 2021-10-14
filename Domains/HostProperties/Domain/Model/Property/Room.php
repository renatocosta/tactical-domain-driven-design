<?php

namespace Domains\HostProperties\Domain\Model\Property;

use Assert\Assert;
use CrossCutting\ValueObjects\ValueObject;

final class Room implements ValueObject
{

    public int $width;

    public int $height;

    public function __construct(int $width, int $height)
    {
        Assert::lazy()
            ->that($width)->notEmpty()->length(200)
            ->that($height)->notEmpty()->length(100)
            ->verifyNow();

        $this->width = $width;
        $this->height = $height;
    }

    public function isSame(ValueObject $size): bool
    {

        if (!$size instanceof self) {
            return false;
        }

        return $this->toNative() === $size->toNative();
    }

    public static function fromNative(array $native): self
    {
        return new self($native['width'], $native['height']);
    }

    public function toNative(): array
    {
        return ['width' => $this->width, 'height' => $this->height];
    }

    public function __toString(): string
    {
        return sprintf('width %s height %s', $this->width, $this->height);
    }
}
