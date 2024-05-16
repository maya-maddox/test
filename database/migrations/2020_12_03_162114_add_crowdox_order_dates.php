<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCrowdoxOrderDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crowd_ox_orders', function (Blueprint $table) {
            $table->datetime('co_created_at')->before('raw_json')->nullable();
            $table->datetime('co_invited_at')->before('raw_json')->nullable();
            $table->datetime('co_approved_at')->before('raw_json')->nullable();
            $table->datetime('co_cancelled_at')->before('raw_json')->nullable();
            $table->datetime('co_refused_at')->before('raw_json')->nullable();
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
            $table->dropColumn('co_created_at');
            $table->dropColumn('co_invited_at');
            $table->dropColumn('co_approved_at');
            $table->dropColumn('co_cancelled_at');
            $table->dropColumn('co_refused_at');
        });
    }
}
