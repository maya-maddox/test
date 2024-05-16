<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->string('internal_return_id')->unique();
            $table->foreignId('service_center_id')->constrained();
            $table->string('supportsync_reference')->nullable();
            $table->string('zendesk_reference')->nullable();
            $table->string('other_reference')->nullable();
            $table->datetime('recieved_date');
            $table->foreignId('sku_id')->constrained();
            $table->foreignId('check_in_user_id')->references('id')->on('users');
            $table->foreignId('technician_id')->nullable()->references('id')->on('users');
            $table->datetime('tested_date')->nullable();
            $table->string('return_reason');
            $table->string('refund_type')->nullable();
            $table->boolean('customer_aware')->nullable();
            $table->boolean('all_checks')->nullable();
            $table->datetime('completed_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
}
