<?php

namespace Werxe\Addresses\Tests\Models;

use Werxe\Addresses\Tests\Stubs\User;
use Werxe\Addresses\Tests\FunctionalTestCase;

class AddressTest extends FunctionalTestCase
{
    /** @test */
    public function it_can_determine_if_the_address_is_the_primary_address()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $address = $user->createAddress($this->getAddressAttributes());

        $this->assertFalse($address->is_primary);
        $this->assertFalse($address->isPrimary());

        $address->makePrimary();

        $this->assertTrue($address->is_primary);
        $this->assertTrue($address->isPrimary());
    }
}
