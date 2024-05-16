<?php

use App\CrowdOxCountry;
use App\CrowdOxProject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectIdentifierAndCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crowd_ox_projects', function (Blueprint $table) {
            $table->string('identifier')->after('currency')->nullable();
            $table->foreignId('crowd_ox_country_id')->after('identifier')->nullable();
        });

        foreach (CrowdOxProject::all() as $project) {
            $json = json_decode($project->raw_data);
            $country = CrowdOxCountry::where('crowd_ox_id', $json->relationships->country->data->id)->firstOrFail();
            $project->update([
                "identifier" => $json->attributes->identifier,
                "crowd_ox_country_id" => $country->id
            ]);
        }

        Schema::table('crowd_ox_projects', function (Blueprint $table) {
            $table->string('identifier')->nullable(false)->change();
            $table->foreignId('crowd_ox_country_id')->nullable(false)->change();

            $table->foreign('crowd_ox_country_id')->references('id')->on('crowd_ox_countries');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crowd_ox_projects', function (Blueprint $table) {
            $table->dropForeign(['crowd_ox_country_id']);

            $table->dropColumn('identifier');
            $table->dropColumn('crowd_ox_country_id');
        });
    }
}
