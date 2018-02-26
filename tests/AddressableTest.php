<?php

namespace Werxe\Addresses\Tests;

use Werxe\Addresses\Tests\Stubs\User;
use Werxe\Addresses\Tests\Stubs\Address;

class AddressableTest extends FunctionalTestCase
{
    /** @test */
    public function it_can_determine_if_an_entity_has_addresses()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $this->assertFalse($user->hasAddresses());
    }

    /** @test */
    public function it_can_create_a_new_address_on_an_entity()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $address = $user->createAddress($this->getAddressAttributes());

        $this->assertTrue($user->hasAddresses());
        $this->assertSame(1, $address->entity->id);
    }

    /** @test */
    public function it_can_delete_all_the_addresses_from_an_entity()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $user->createAddress($this->getAddressAttributes());
        $user->createAddress($this->getAddressAttributes());
        $user->createAddress($this->getAddressAttributes());

        $this->assertSame(3, $user->addresses->count());

        $user->deleteAllAddresses();

        $user = $user->fresh();

        $this->assertFalse($user->hasAddresses());
    }

    /** @test */
    public function it_can_determine_if_the_entity_has_a_primary_address()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $user->createAddress($this->getAddressAttributes());
        $user->createAddress($this->getAddressAttributes());

        $this->assertFalse($user->hasPrimaryAddress());
    }

    /** @test */
    public function it_can_make_an_existing_address_the_primary_address()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $user->createAddress($this->getAddressAttributes());
        $user->createAddress($this->getAddressAttributes());

        $this->assertFalse($user->hasPrimaryAddress());

        $user->addresses->first()->makePrimary();

        $this->assertTrue($user->hasPrimaryAddress());
    }

    /** @test */
    public function it_can_create_a_new_primary_address()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $address1 = $user->createAddress($this->getAddressAttributes());

        $this->assertFalse($address1->isPrimary());

        $address1->makePrimary();

        $this->assertTrue($address1->isPrimary());

        $address2 = $user->createPrimaryAddress($this->getAddressAttributes());

        $address1 = $address1->fresh();

        $this->assertFalse($address1->isPrimary());
        $this->assertTrue($address2->isPrimary());
    }

    /** @test  */
    public function it_can_get_and_set_the_address_model()
    {
        $class = Address::class;

        User::setAddressModel($class);

        $this->assertSame($class, User::getAddressModel());
    }

    /** @test */
    public function if_an_entity_is_deleted_the_related_addresses_are_also_deleted()
    {
        $user = User::create(['email' => 'john@doe.com']);

        $user->createAddress($this->getAddressAttributes());
        $user->createAddress($this->getAddressAttributes());

        $this->assertTrue($user->hasAddresses());

        $user->delete();

        $this->assertSame(0, Address::count());
    }
}
