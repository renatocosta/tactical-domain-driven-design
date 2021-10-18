<?php

namespace Tests\HostProperties\Property\Model;

use DG\BypassFinals;
use Domains\HostProperties\Domain\Model\Property\Address;
use Domains\HostProperties\Domain\Model\Property\Property;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Domains\HostProperties\Domain\Model\Property\Room;
use Mockery;
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

    /**
     * @testWith [0, 1]
     *           [1, 0]
     *           [1, 1]
     *           [-1, 0]
     *           [-1, -1]
     */
    public function testShouldFailToRoomWhenValuesAreMissing(int $width, int $height)
    {
        $this->expectException(PropertyException::class);
        new Room($width, $height);
    }

    /**
     * @testWith ["av j", "Miami", "Fl", "USA", "0357021"]
     *           ["av SSj", "Arizona", "Phoenix", "USA", "021901"]
     */
    public function testShouldFailToAddressWhenValuesAreMissing(string $street, string $city, string $state, string $country, string $zipcode)
    {
        $this->expectException(PropertyException::class);
        new Address($street, $city, $state, $country, $zipcode);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}
