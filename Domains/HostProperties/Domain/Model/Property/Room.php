<?php

namespace Domains\HostProperties\Domain\Model\Property;

use Assert\Assert;
use Assert\AssertionFailedException;
use Common\ValueObjects\ValueObject;

final class Room implements ValueObject
{

    public int $width;

    public int $height;

    public const MIN_WIDTH = 10;

    public const MAX_WIDTH = 60;

    public function __construct(int $width, int $height)
    {
        try {
            Assert::that($width)->notEmpty()->greaterOrEqualThan(2);
            Assert::that($height)->notEmpty();
        } catch (AssertionFailedException $e) {
            throw new PropertyException($e->getMessage());
        }

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
