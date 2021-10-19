<?php

namespace Tests\HostProperties\Property\Model;

use Common\Application\Event\Bus\DomainEventBus;
use Common\DataConsistency\UnitOfWork;
use Common\Policy\IPolicy;
use Common\ValueObjects\Identity\Guid;
use DG\BypassFinals;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyCreatedEventHandler;
use Domains\HostProperties\Application\EventHandlers\Property\PropertyRejectedEventHandler;
use Domains\HostProperties\Domain\Model\Property\Address;
use Domains\HostProperties\Domain\Model\Property\IPropertyRepository;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\PropertyEntity;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Domains\HostProperties\Domain\Model\Property\Room;
use Mockery;
use Ramsey\Uuid\Uuid;
use TestCase;

class PropertyTest extends TestCase
{

    //protected $mockedRoom;

    public static function setUpBeforeClass(): void
    {
        BypassFinals::enable();
    }

    public function setUp(): void
    {
        parent::setup();
        /*$this->mockedRoom =
            Mockery::mock(Room::class);*/
    }

    public function testShouldFailToCheckinDateLessThanNow()
    {

        $this->expectException(PropertyException::class);

        $domainEventBus = Mockery::spy(new DomainEventBus());
        $domainEventBus->subscribers([new PropertyCreatedEventHandler($this->app[IPolicy::class], $this->app[IPropertyRepository::class]), new PropertyRejectedEventHandler(new UnitOfWork())]);

        $domainEventBus->shouldNotReceive('publish');
        $address = new Address('Av jejj kshjkjhskjhs jkhkh', 'Phoenix', 'Arizona', 'USA', '0672612');
        $room = new Room(2, 2);
        $property = Mockery::spy(new PropertyEntity($domainEventBus));
        $property->of(Guid::from(Uuid::uuid4()), $address, $room);
        $property->checkin(1552296328);
    }

    public function testShouldFailToCheckoutDateLessThanNow()
    {

        $this->expectException(PropertyException::class);

        $domainEventBus = Mockery::spy(new DomainEventBus());
        $domainEventBus->subscribers([new PropertyCreatedEventHandler($this->app[IPolicy::class], $this->app[IPropertyRepository::class]), new PropertyRejectedEventHandler(new UnitOfWork())]);

        $domainEventBus->shouldNotReceive('publish');
        $address = new Address('Av jejj kshjkjhskjhs jkhkh', 'Phoenix', 'Arizona', 'USA', '0672612');
        $room = new Room(2, 2);
        $property = Mockery::spy(new PropertyEntity($domainEventBus));
        $property->of(Guid::from(Uuid::uuid4()), $address, $room);
        $property->checkout(1552296328);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
