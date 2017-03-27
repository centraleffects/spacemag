<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('article_shop', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')->on('articles');

            $table->integer('shop_id')->unsigned()->index();
            $table->foreign('shop_id')->references('id')->on('shops');
            
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
        Schema::dropIfExists('article_shop');
    }
}
