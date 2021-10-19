<?php

namespace Tests\HostProperties\Property\Model;

use DG\BypassFinals;
use Domains\HostProperties\Domain\Model\Property\Address;
use Domains\HostProperties\Domain\Model\Property\PropertyException;
use Mockery;
use TestCase;

class AddressTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        BypassFinals::enable();
    }

    public function setUp(): void
    {
        parent::setup();
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
