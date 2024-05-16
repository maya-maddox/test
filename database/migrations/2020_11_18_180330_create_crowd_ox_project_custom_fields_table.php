<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxProjectCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_project_custom_fields', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id');
            $table->string('name');
            $table->string('key');
            $table->string('type');
            $table->foreignId('crowd_ox_project_id');
            $table->json('raw_data');
            $table->timestamps();

            $table->foreign('crowd_ox_project_id')->references('id')->on('crowd_ox_projects');
        });

        Schema::create('crowd_ox_order_crowd_ox_project_custom_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crowd_ox_project_custom_field_id');
            $table->foreignId('crowd_ox_order_id');
            $table->string('value');
            $table->timestamps();

            //custom foreign key names as auto-generated was over 64 characters
            $table->foreign('crowd_ox_project_custom_field_id', 'crowd_ox_order_crowd_ox_project_custom_field_field_foreign')->references('id')->on('crowd_ox_project_custom_fields');
            $table->foreign('crowd_ox_order_id', 'crowd_ox_order_crowd_ox_project_custom_field_order_foreign')->references('id')->on('crowd_ox_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crowd_ox_order_crowd_ox_project_custom_field');
        Schema::dropIfExists('crowd_ox_project_custom_fields');
    }
}
