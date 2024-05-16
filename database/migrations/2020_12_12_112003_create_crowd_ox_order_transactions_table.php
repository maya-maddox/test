<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdOxOrderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_ox_order_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('crowd_ox_id')->unsigned();
            $table->foreignId('crowd_ox_project_id');
            $table->foreignId('crowd_ox_order_id');
            $table->integer('amount_cents');
            $table->integer('shipping_amount_cents');
            $table->string('currency');
            $table->boolean('confirmed');
            $table->datetime('paid_at');
            $table->json('raw_data');
            $table->timestamps();

            $table->foreign('crowd_ox_project_id')->references('id')->on('crowd_ox_projects');
            $table->foreign('crowd_ox_order_id')->references('id')->on('crowd_ox_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crowd_ox_order_transactions');
    }
}
