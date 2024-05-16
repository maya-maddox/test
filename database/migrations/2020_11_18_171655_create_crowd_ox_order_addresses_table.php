<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_order_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id');
            $table->string('name');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->foreignId('crowd_ox_project_id');
            $table->foreignId('crowd_ox_order_id');
            $table->foreignId('crowd_ox_country_id');
            $table->foreignId('crowd_ox_state_id')->nullable();
            $table->json('raw_data');
            $table->timestamps();

            $table->foreign('crowd_ox_project_id')->references('id')->on('crowd_ox_projects');
            $table->foreign('crowd_ox_order_id')->references('id')->on('crowd_ox_orders');
            $table->foreign('crowd_ox_country_id')->references('id')->on('crowd_ox_countries');
            $table->foreign('crowd_ox_state_id')->references('id')->on('crowd_ox_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crowd_ox_order_addresses');
    }
}
