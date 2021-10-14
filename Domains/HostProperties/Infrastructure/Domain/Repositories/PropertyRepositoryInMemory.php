<?php

namespace Domains\HostProperties\Infrastructure\Domain\Repositories;

use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Property;
use Illuminate\Contracts\Cache\Repository as Cache;

final class PropertyRepositoryInMemory implements IPropertyRepository 
{

    private IPropertyRepository $propertyRepository;

    private Cache $cache;

    public function __construct(IPropertyRepository $propertyRepository, Cache $cache)
    {
        $this->propertyRepository = $propertyRepository;
        $this->cache = $cache;
    }

    public function findAll(): array
    {
        return $this->cache->tags('properties')->remember('all', 60, function () {
            return $this->accountRepository->findAll();
        });
    }

    public function update(Property $property): void
    {

    }

    public function create(Property $property): void
    {
        $this->cache->tags('properties')->flush();
        $this->propertyRepository->create($property);
    }

    public function findById(int $propertyId): Property
    {

    }

    public function countFor(Property $property): int
    {

    }
    

}