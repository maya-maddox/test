<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnItemDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_item_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('diagnosis');
            $table->foreignId('sku_type_id')->constrained();
            $table->timestamps();
        });

        Schema::table('return_items', function (Blueprint $table) {
            $table->renameColumn('diagnosis', 'custom_diagnosis');
        });
        
        Schema::table('return_items', function (Blueprint $table) {
            $table->foreignId('return_item_diagnosis_id')->nullable();

            $table->foreign('return_item_diagnosis_id', 'return_items_return_item_diagnosis_id_foreign')->references('id')->on('return_item_diagnoses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('return_items', function (Blueprint $table) {
            $table->renameColumn('custom_diagnosis', 'diagnosis');
            $table->dropForeign('return_items_return_item_diagnosis_id_foreign');
            $table->dropColumn('return_item_diagnosis_id');
        });

        Schema::dropIfExists('return_item_diagnoses');
    }
}
