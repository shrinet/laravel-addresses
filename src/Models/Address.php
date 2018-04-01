<?php

declare(strict_types=1);

namespace Werxe\Addresses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Werxe\Addresses\Models\Contracts\Address as AddressContract;

class Address extends Model implements AddressContract
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'addresses';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'is_primary',
        'full_name',
        'company_name',
        'line1',
        'line2',
        'state',
        'region',
        'postal_code',
        'country',
        'phone_number',
        'instructions',
    ];

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'is_primary' => 'bool',
    ];

    /**
     * {@inheritdoc}
     */
    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * {@inheritdoc}
     */
    public function scopeWherePrimary(Builder $builder): Builder
    {
        return $builder->where('is_primary', true);
    }

    /**
     * {@inheritdoc}
     */
    public function makePrimary(): AddressContract
    {
        $this->entity->addresses()->where('is_primary', 1)->update(['is_primary' => 0]);

        $this->update(['is_primary' => 1]);

        return $this->fresh();
    }

    /**
     * {@inheritdoc}
     */
    public function isPrimary(): bool
    {
        return $this->is_primary === true;
    }
}
