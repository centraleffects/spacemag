<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('salespots'))  

         Schema::create('salespots', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->integer('shop_id')->unsigned()->index();
            $table->foreign('shop_id')->references('id')->on('shops');

            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')->on('articles');

            $table->string('spot_code')->nullable();
            $table->string('spot_location')->nullable();

            $table->string('name');
            $table->longText('description')->nullable();

            $table->string('aisle')->nullable();
            $table->string('size')->nullable();

            $table->enum('status', ['rebuilding', 'painting', 'on repair', 'available'])->nullable();

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
         Schema::dropIfExists('salespots');
    }
}