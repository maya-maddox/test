<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_order_lines', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id');
            $table->string('type');
            $table->foreignId('crowd_ox_project_id');
            $table->foreignId('crowd_ox_order_id');
            $table->foreignId('crowd_ox_product_id')->nullable();
            $table->json('raw_data');
            $table->timestamps();

            $table->foreign('crowd_ox_project_id')->references('id')->on('crowd_ox_projects');
            $table->foreign('crowd_ox_order_id')->references('id')->on('crowd_ox_orders');
            $table->foreign('crowd_ox_product_id')->references('id')->on('crowd_ox_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crowd_ox_order_lines');
    }
}
