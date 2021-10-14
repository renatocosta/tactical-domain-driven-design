<?php

namespace Domains\Context\BankAccount\Application\UseCases\Account;

interface IGetAccountsQuery
{

    public function execute(): array;
}
