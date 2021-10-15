<?php

namespace Common\Policy;

interface IPolicy
{

    /**
     * @param mixed $object
     * @return bool
     */
    public function isValid($object): bool;
}
