<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('crowd_ox_order_lines', function (Blueprint $table) {
            $table->integer('product_price_cents')->nullable()->after('type');
            $table->integer('shipping_price_cents')->nullable()->after('product_price_cents');
            $table->integer('total_price_cents')->nullable()->after('shipping_price_cents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crowd_ox_order_lines', function (Blueprint $table) {
            $table->dropColumn('product_price_cents');
            $table->dropColumn('shipping_price_cents');
            $table->dropColumn('total_price_cents');
        });
    }
};
