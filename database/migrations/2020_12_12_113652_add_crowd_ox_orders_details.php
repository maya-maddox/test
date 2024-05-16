<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCrowdOxOrdersDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crowd_ox_orders', function (Blueprint $table) {
            $table->integer('amount_cents')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->string('authentication_token')->nullable();
            $table->string('external_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crowd_ox_orders', function (Blueprint $table) {
            $table->dropColumn('amount_cents');
            $table->dropColumn('status');
            $table->dropColumn('notes');
            $table->dropColumn('authentication_token');
            $table->dropColumn('external_id');
        });
    }
}
