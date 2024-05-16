<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrowdOxCountriesIso3To2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crowd_ox_countries', function (Blueprint $table) {
            $table->renameColumn('iso3', 'iso2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crowd_ox_countries', function (Blueprint $table) {
            $table->renameColumn('iso2', 'iso3');
        });
    }
}
