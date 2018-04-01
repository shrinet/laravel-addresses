<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->morphs('entity');

            $table->boolean('is_primary')->default(false);

            $table->string('full_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('line1')->nullable();
            $table->string('line2')->nullable();
            $table->string('state')->nullable();
            $table->string('region')->nullable();
            $table->string('postal_code')->nullable();
            $table->char('country', 2)->nullable();
            $table->string('phone_number')->nullable();
            $table->text('instructions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
