<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('article_transactions', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->foreign('salespot_id')->references('id')->on('salespots');
            $table->foreign('user_id')->references('id')->on('users');        
            
            $table->string('user_id_cashier')->nullable();

            $table->decimal('quantity', 5,2)->nullable();
            $table->decimal('amount', 5,2)->nullable();
            $table->decimal('price', 5,2)->nullable();
            $table->decimal('original_price', 5,2)->nullable();

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
        Schema::dropIfExists('article_transactions');
    }
}