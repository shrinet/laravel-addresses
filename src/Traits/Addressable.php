<?php

namespace Werxe\Addresses\Traits;

use Werxe\Addresses\Models\Address as AddressModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Werxe\Addresses\Models\Contracts\Address as AddressContract;

trait Addressable
{
    /**
     * The Address model.
     *
     * @var string
     */
    protected static $addressModel = AddressModel::class;

    /**
     * Boot the Addressable trait for the model.
     *
     * @return void
     */
    public static function bootAddressable(): void
    {
        static::deleted(function (self $model) {
            $model->deleteAllAddresses();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(static::$addressModel, 'entity');
    }

    /**
     * {@inheritdoc}
     */
    public function hasAddresses(): bool
    {
        return (bool) $this->addresses->count();
    }

    /**
     * {@inheritdoc}
     */
    public function hasPrimaryAddress(): bool
    {
        return (bool) $this->addresses()->wherePrimary()->count();
    }

    /**
     * {@inheritdoc}
     */
    public function createAddress(array $attributes): AddressContract
    {
        return $this->addresses()->create($attributes)->fresh();
    }

    /**
     * {@inheritdoc}
     */
    public function createPrimaryAddress(array $attributes): AddressContract
    {
        return $this->createAddress($attributes)->makePrimary();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAllAddresses(): bool
    {
        return $this->addresses()->delete();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAddressModel(): string
    {
        return static::$addressModel;
    }

    /**
     * {@inheritdoc}
     */
    public static function setAddressModel(string $model): void
    {
        static::$addressModel = $model;
    }
}
