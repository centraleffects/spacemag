<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnInSalespotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salespot_prices', function(Blueprint $table) {
            $table->decimal('daily', 5,2)->nullable();
            $table->decimal('week1', 5,2)->nullable();
            $table->decimal('week2', 5,2)->nullable();
            $table->decimal('week3', 5,2)->nullable();
            $table->decimal('week4', 5,2)->nullable();

            $table->dropColumn('price_per_day');
            $table->dropColumn('price_per_3d');
            $table->dropColumn('price_per_week');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
