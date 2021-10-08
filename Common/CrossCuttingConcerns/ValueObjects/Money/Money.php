<?php

namespace CrossCutting\ValueObjects\Money;

final class Money
{

    public float $value;

    public Currency $currency;

    public function __construct(float $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public function add(float $value): Money
    {
        return new Money($this->value + $value, $this->currency);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
