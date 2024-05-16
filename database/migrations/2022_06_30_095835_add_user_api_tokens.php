<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserApiTokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //https://laravel.com/docs/5.8/api-authentication#database-preparation
    {
        Schema::table('users', function ($table) {
            $table->string('api_token', 80)->after('google_token')
                                ->unique()
                                ->nullable()
                                ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('api_token');
        });
    }
}
