<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespotPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('salespot_prices', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->integer('salespot_id')->unsigned()->index();
            $table->foreign('salespot_id')->references('id')->on('salespots');

            $table->decimal('price_per_day', 5, 2)->nullable();
            $table->decimal('price_per_3d', 5, 2)->nullable();
            $table->decimal('price_per_week', 5, 2)->nullable();
            $table->smallInteger('is_active')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('salespot_prices');
    }
}