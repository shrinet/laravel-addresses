<?php

declare(strict_types=1);

namespace Werxe\Addresses\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Werxe\Addresses\Traits\Addressable as AddressableTrait;
use Werxe\Addresses\Traits\Contracts\Addressable as AddressableContract;

class User extends Model implements AddressableContract
{
    use AddressableTrait;

    protected $fillable = ['email'];
}
