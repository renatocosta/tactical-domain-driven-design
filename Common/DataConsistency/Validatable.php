<?php

namespace Domains\CrossCutting\DataConsistency;

interface Validatable
{

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return array
     */
    public function getErrors(): array;  

}