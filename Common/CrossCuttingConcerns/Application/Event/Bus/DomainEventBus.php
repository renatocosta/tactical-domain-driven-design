<?php

namespace CrossCutting\Domain\Application\Event\Bus;

use CrossCutting\Domain\Application\Event\AbstractEvent;
use CrossCutting\Domain\Application\Event\DomainEventHandler;
use Exception;
use InvalidArgumentException;

final class DomainEventBus
{

    /**
     * @var \SplDoublyLinkedList
     */
    private $eventHandlers;

    public function __construct()
    {
        $this->eventHandlers = new \SplDoublyLinkedList();
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    public function subscribers(array $subscribers): void
    {

        if (count($subscribers) === 0) throw new Exception('Subscribers are mandatory');

        foreach ($subscribers as $subscriber) {
            if (!$subscriber instanceof DomainEventHandler) throw new InvalidArgumentException('Subscriber given can not be an instance of DomainEventHanlder');
            $this->subscribe($subscriber);
        }
    }

    public function subscribe(DomainEventHandler $aDomainEventHandler): void
    {
        $this->eventHandlers->push($aDomainEventHandler);
    }

    public function publish(AbstractEvent $aDomainEvent): void
    {

        for ($this->eventHandlers->rewind(); $this->eventHandlers->valid(); $this->eventHandlers->next()) {
            $eventHandler = $this->eventHandlers->current();

            if ($eventHandler->isSubscribedTo($aDomainEvent)) {
                $eventHandler->handle($aDomainEvent);
                break;
            }
        }
    }
}
