<?php

namespace Werxe\Addresses\Traits\Contracts;

use Werxe\Addresses\Models\Contracts\Address;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Addressable
{
    /**
     * Returns the Addresses attached to the Entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany;

    /**
     * Determines if the Entity has Addresses.
     *
     * @return bool
     */
    public function hasAddresses(): bool;

    /**
     * Determines if the Entity has a primary Address.
     *
     * @return bool
     */
    public function hasPrimaryAddress(): bool;

    /**
     * Creates a new Address on the Entity with the given attributes.
     *
     * @param array $attributes
     *
     * @return \Werxe\Addresses\Models\Contracts\Address
     */
    public function createAddress(array $attributes): Address;

    /**
     * Creates a new primary Address on the Entity with the given attributes.
     *
     * @param array $attributes
     *
     * @return \Werxe\Addresses\Models\Contracts\Address
     */
    public function createPrimaryAddress(array $attributes): Address;

    /**
     * Deletes all the Addresses attached to the Entity.
     *
     * @return bool
     */
    public function deleteAllAddresses(): bool;

    /**
     * Returns the Address model name.
     *
     * @return string
     */
    public static function getAddressModel(): string;

    /**
     * Sets the Address model name.
     *
     * @param string $model
     *
     * @return void
     */
    public static function setAddressModel(string $model);
}
