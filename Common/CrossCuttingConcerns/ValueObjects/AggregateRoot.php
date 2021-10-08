<?php

namespace CrossCutting\Domain\Model\ValueObjects;

use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Application\Event\EventInterface;

abstract class AggregateRoot
{

    /**
     * @var DomainEventBus
     */
    protected $domainEventBus;

    protected function __construct(DomainEventBus $domainEventBus)
    {
        $this->domainEventBus = $domainEventBus;
    }

    protected function raise(EventInterface $event): void
    {
        $this->domainEventBus->publish($event);
    }

}