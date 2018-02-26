<?php

namespace Werxe\Addresses\Models\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;

interface Address
{
    /**
     * Returns the Entity that this Address belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity(): MorphTo;

    /**
     * Finds the primary Address.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWherePrimary(Builder $builder): Builder;

    /**
     * Sets the Address as the primary Address.
     *
     * @return \Werxe\Addresses\Models\Contracts\Address
     */
    public function makePrimary(): Address;

    /**
     * Determines if the Address is a primary Address.
     *
     * @return bool
     */
    public function isPrimary(): bool;
}
