<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleSpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if( !Schema::hasTable('article_spots'))  {
            Schema::create('article_spots', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('article_id')->unsigned()->index();
                $table->foreign('article_id')->references('id')->on('articles');

                $table->integer('salespot_id')->unsigned()->index();
                $table->foreign('salespot_id')->references('id')->on('salespots');

                $table->timestamps();
                $table->softDeletes();
            });     
         }   

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_spots');
    }
}
