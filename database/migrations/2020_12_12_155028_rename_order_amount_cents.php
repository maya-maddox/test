<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOrderAmountCents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crowd_ox_orders', function (Blueprint $table) {
            $table->renameColumn('amount_cents', 'price_cents');
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
            $table->renameColumn('price_cents', 'amount_cents');
        });
    }
}
