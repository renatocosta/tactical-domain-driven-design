<?php

namespace Domains\HostProperties\Application\UseCases\Property\Queries;

use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;

final class GetAllAccountsQuery implements IGetAccountsQuery
{

    private IPropertyRepository $propertyRepository;

    public function __construct(IPropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function execute(): array
    {
        return $this->propertyRepository->findAll();
    }
}
