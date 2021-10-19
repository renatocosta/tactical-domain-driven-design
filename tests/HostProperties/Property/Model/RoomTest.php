<?php

namespace Tests\HostProperties\Property\Model;

use DG\BypassFinals;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Domains\HostProperties\Domain\Model\Property\Room;
use Mockery;
use TestCase;

class RoomTest extends TestCase
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

    public function tearDown(): void
    {
        Mockery::close();
    }
}
