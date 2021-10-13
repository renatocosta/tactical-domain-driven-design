<?php

namespace Domains\Context\BankAccount\Domain\Model\Account;

use Assert\Assert;
use CrossCutting\Domain\Application\Event\Bus\DomainEventBus;
use CrossCutting\Domain\Model\ValueObjects\AggregateRoot;
use Domains\Context\BankAccount\Domain\Model\Account\Account;
use Domains\Context\BankAccount\Domain\Model\Account\AccountCreated;
use Domains\Context\BankAccount\Domain\Model\Account\AccountRejected;
use Domains\Context\BankAccount\Domain\Model\Account\Balance;

final class AccountEntity extends AggregateRoot implements Account
{

    private Identified $identifier;

    private $customerId;

    private $accountName;

    private $balance;

    public function __construct(DomainEventBus $domainEventBus)
    {
        parent::__construct($domainEventBus);
    }

    public function createNew(Identified $identifier, int $customerId, string $accountName, Balance $balance): void
    {

        Assert::that($customerId, 'CUSTOMER_ID_CAN_NOT_BE_ZERO_OR_NEGATIVE')->greaterThan(0);

        $this->identifier = $identifier;
        $this->customerId = $customerId;
        $this->accountName = $accountName;
        $this->balance = $balance;

    }

    public function fromExisting(Identified $identifier, int $customerId, string $accountName, Balance $balance): void
    {

        Assert::that($customerId, 'CUSTOMER_ID_CAN_NOT_BE_ZERO_OR_NEGATIVE')->greaterThan(0);

        $this->identifier = $identifier;
        $this->customerId = $customerId;
        $this->accountName = $accountName;
        $this->balance = $balance;

    }

    public function credit(Money $amount): void
    {
        //BUsiness logic here    
        $this->raise(new AccountCreditPlaced($this));
    }

    public function debit(Money $amount): void
    {
        //BUsiness logic here    
        $this->raise(new AccountDebitPlaced($this));
    }

    public function setCustomerId(int $id): void
    {
        $this->customerId = $id;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setAccountName(String $name): void
    {
        $this->accountName = $name;
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function getBalance(): Balance
    {
        return $this->balance;
    }

    public function setId(Identified $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return sprintf('Customer Id %s Customer name %s Balance %f', $this->customerId, $this->accountName, $this->balance->value);
    }
}
