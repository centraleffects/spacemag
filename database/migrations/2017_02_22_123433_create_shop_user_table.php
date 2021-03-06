<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('shop_user'))  

         Schema::create('shop_user', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->integer('shop_id')->unsigned()->index();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('newsletter_subscribed')->default(false);

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
         Schema::dropIfExists('shop_user');
    }
}