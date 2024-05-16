<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id');
            $table->foreignId('crowd_ox_project_id');
            $table->foreignId('crowd_ox_customer_id');
            $table->json('raw_data');
            $table->timestamps();

            $table->index('crowd_ox_id');

            $table->foreign('crowd_ox_project_id')->references('id')->on('crowd_ox_projects');
            $table->foreign('crowd_ox_customer_id')->references('id')->on('crowd_ox_customers');
        });


        Schema::create('crowd_ox_order_crowd_ox_order_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crowd_ox_order_id');
            $table->foreignId('crowd_ox_order_tag_id');
            $table->timestamps();

            $table->foreign('crowd_ox_order_id')->references('id')->on('crowd_ox_orders');
            $table->foreign('crowd_ox_order_tag_id')->references('id')->on('crowd_ox_order_tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crowd_ox_order_crowd_ox_order_tag');
        Schema::dropIfExists('crowd_ox_orders');
    }
}
