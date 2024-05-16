<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id');
            $table->string('name');
            $table->string('email');
            $table->json('raw_data');
            $table->timestamps();


            $table->index('crowd_ox_id');
        });


        Schema::create('crowd_ox_customer_crowd_ox_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crowd_ox_customer_id');
            $table->foreignId('crowd_ox_project_id');
            $table->timestamps();

            $table->foreign('crowd_ox_customer_id')->references('id')->on('crowd_ox_customers');
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
        Schema::dropIfExists('crowd_ox_customers');
    }
}
