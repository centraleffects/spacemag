<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShopIdToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (!Schema::hasColumn('articles', 'shop_id'))
            {
                Schema::table('articles', function(Blueprint $table) {

                   $table->integer('shop_id')->unsigned()->index()->nullable()->after('user_id');
                   $table->foreign('shop_id')->references('id')->on('shops');

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
        //
    }
}
