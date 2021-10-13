<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use CrossCutting\Domain\Application\Event\AbstractEvent;

class AccountCreditPlaced extends AbstractEvent
{

    public $account;

    public function __construct(Account $account)
    {
        parent::__construct();
        $this->account = $account;
    }
}
