<?php

namespace CrossCutting\ValueObjects;

interface ValueObject
{

    public function isSame(ValueObject $object): bool;

}
