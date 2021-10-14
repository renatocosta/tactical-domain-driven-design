<?php

namespace Common\CrossCuttingConcerns\DataConsistency;

/**
 * The unit of work manages in-memory database CRUD operations on entities as an isolated transaction
 */
interface IUnitOfWork
{

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;

}