<?php

namespace Werxe\Addresses\Tests;

use Illuminate\Support\Facades\Schema;

class FunctionalTestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testbench']);

        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Werxe\Addresses\AddressesServiceProvider'];
    }

    protected function getAddressAttributes(array $attributes = [])
    {
        return array_merge([
            'name' => 'John Doe',
            'country' => 'US',
            'street_name' => '1600 Pennsylvania Avenue NW',
            'city' => 'Washington',
            'region' => 'DC',
            'postal_code' => '20500',
        ], $attributes);
    }
}
