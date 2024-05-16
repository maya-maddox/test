<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_products', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id');
            $table->string('type');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('crowd_ox_project_id');
            $table->json('raw_data');
            $table->timestamps();

            $table->foreign('crowd_ox_project_id')->references('id')->on('crowd_ox_projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crowd_ox_products');
    }
}
