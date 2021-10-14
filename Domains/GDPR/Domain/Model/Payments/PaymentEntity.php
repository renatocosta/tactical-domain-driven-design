<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Model\ValueObjects\AggregateRoot;

final class PaymentEntity extends AggregateRoot implements Payment
{

    public function __construct(DomainEventBus $domainEventBus)
    {
        parent::__construct($domainEventBus);
    }

    public function isValid(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
