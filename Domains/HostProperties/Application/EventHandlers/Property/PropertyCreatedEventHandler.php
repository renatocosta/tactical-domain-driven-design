<?php

namespace Domains\HostProperties\Application\EventHandlers\Property;

use CrossCutting\Domain\Application\Event\AbstractEvent;
use CrossCutting\Domain\Application\Event\DomainEventHandler;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyCreated;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Illuminate\Support\Facades\Log;

final class PropertyCreatedEventHandler implements DomainEventHandler
{

    private IPropertyRepository $propertyRepository;

    public function __construct(IPropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
        $this->propertyRepository->create($domainEvent->property);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof PropertyCreated;
    }
}
