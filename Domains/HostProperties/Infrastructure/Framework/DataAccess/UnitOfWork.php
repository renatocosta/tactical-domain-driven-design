<?php

namespace Domains\HostProperties\Infrastructure\Framework\DataAccess;

use Common\DataConsistency\IUnitOfWork;

final class UnitOfWork implements IUnitOfWork
{

    public function beginTransaction(): void
    {
        \DB::beginTransaction();
    }

    public function commit(): void
    {
        \DB::commit();
    }

    public function rollback(): void
    {
        \DB::rollBack();
    }

}