<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllowReturnsLogCustomSku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (env("DB_CONNECTION") != "sqlite")
        {
            Schema::table("returns", function (Blueprint $table) {
                $table->dropForeign('returns_sku_id_foreign');
            });
        }

        Schema::table("returns", function (Blueprint $table) {            
            $table->foreignId("sku_id")->nullable(true)->change();
            $table->string("custom_sku")->nullable()->after("sku_id");

            $table->foreign('sku_id', 'returns_sku_id_foreign')->references('id')->on('skus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (env("DB_CONNECTION") != "sqlite")
        {
            Schema::table("returns", function (Blueprint $table) {
                $table->dropForeign('returns_sku_id_foreign');
            });
        }

        Schema::table("returns", function (Blueprint $table) {
            $table->foreignId("sku_id")->nullable(false)->change();
            $table->dropColumn("custom_sku");

            $table->foreign('sku_id', 'returns_sku_id_foreign')->references('id')->on('skus');
        });
    }
}
