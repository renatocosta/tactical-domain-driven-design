<?php

namespace Common\ValueObjects;

use Common\Application\Event\Bus\DomainEventBus;
use Common\Application\Event\EventInterface;

abstract class AggregateRoot
{

    /**
     * @var DomainEventBus
     */
    protected $domainEventBus;

    public function __construct(DomainEventBus $domainEventBus)
    {
        $this->domainEventBus = $domainEventBus;
    }

    protected function raise(EventInterface $event): void
    {
        $this->domainEventBus->publish($event);
    }
}
