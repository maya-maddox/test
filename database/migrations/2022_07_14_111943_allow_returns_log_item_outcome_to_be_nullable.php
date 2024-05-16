<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllowReturnsLogItemOutcomeToBeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("return_items", function (Blueprint $table) {            
            $table->string("outcome")->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("return_items", function (Blueprint $table) {
            $table->string("outcome")->nullable(false)->change();
        });
    }
}