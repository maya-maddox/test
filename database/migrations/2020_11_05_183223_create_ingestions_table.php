<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingestions', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->text('raw_data')->nullable();
            $table->text("comments")->nullable();
            $table->string("status");
            $table->foreignId('key_id')->nullable();
            $table->timestamps();

            $table->foreign('key_id')->references('id')->on('keys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingestions');
    }
}
