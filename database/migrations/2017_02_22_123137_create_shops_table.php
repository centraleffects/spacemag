<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('shops'))  

        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('url')->nullable();
            $table->string('currency')->nullable();
            $table->string('slug')->nullable();
            $table->string('commission_article_sale')->nullable();
            $table->string('commission_salespot')->nullable();
            $table->string('x_coordinate')->nullable();
            $table->string('y_coordinate')->nullable();
            $table->string('shop_postel')->nullable();
            $table->string('cleanup_schedule')->nullable();

            // # of days before a client can book a salespot ahead (just like reservation)
            // just like when he wanted to book a specific salespot today but 
            // he wanted his booking to start a specific date because that'll be just the 
            // time he wants to use that sales spot before his booking starts
            $table->integer('spot_free_max_prebook')->default(2); 
            // # of days a client should end his booking 
            $table->integer('spot_max_end_prebook')->default(1); 

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
        Schema::dropIfExists('shops');
    }
}
