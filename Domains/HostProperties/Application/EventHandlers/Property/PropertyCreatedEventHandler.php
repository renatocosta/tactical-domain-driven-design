<?php

namespace Domains\HostProperties\Application\EventHandlers\Property;

use Common\Application\Event\AbstractEvent;
use Common\Application\Event\DomainEventHandler;
use Common\Policy\IPolicy;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyCreated;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Illuminate\Support\Facades\Log;

final class PropertyCreatedEventHandler implements DomainEventHandler
{

    private IPolicy $propertyDuplicatedPolicy;

    private IPropertyRepository $propertyRepository;

    public function __construct(IPolicy $policy, IPropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
        $this->propertyDuplicatedPolicy = $policy;
    }

    public function handle(AbstractEvent $domainEvent): void
    {
        if (!$this->propertyDuplicatedPolicy->isValid($this->propertyRepository)) throw new PropertyException('This property is already registered');
        $this->propertyRepository->create($domainEvent->property);
        Log::info(__CLASS__);
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof PropertyCreated;
    }
}
