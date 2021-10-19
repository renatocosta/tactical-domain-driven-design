<?php

namespace Domains\HostProperties\Application\EventHandlers\Property;

use Common\Application\Event\AbstractEvent;
use Common\Application\Event\DomainEventHandler;
use Common\DataConsistency\IUnitOfWork;
use Domains\HostProperties\Domain\Model\Property\Events\PropertyRejected;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Illuminate\Support\Facades\Log;

final class PropertyRejectedEventHandler implements DomainEventHandler
{

    private IUnitOfWork $unitOfWork;

    public function __construct(IUnitOfWork $unitOfWork)
    {
        $this->unitOfWork = $unitOfWork;
    }

    public function handle(AbstractEvent $domainEvent): void
    {
        Log::info(__CLASS__);
        $this->unitOfWork->rollback();
        throw new PropertyException('Something went wrong while validating a property');
    }

    public function isSubscribedTo(AbstractEvent $domainEvent): bool
    {
        return $domainEvent instanceof PropertyRejected;
    }
}
